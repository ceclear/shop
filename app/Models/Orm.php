<?php
/*
* mark
* date 2021/2/3
* time 16:54
* author zt
*/

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Orm extends Model
{
    protected $dateFormat = "U";

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    const Status = [
        '禁用',
        '正常'
    ];

    /**
     * 获取列表 最后 用指定key作为键
     * @param $where
     * @param string $byKey 结果数组键名
     * @param array $select
     * @param string[] $order
     * @return mixed
     */
    public function getList($where, $limit = 10, $byKey = 'id', $select = [], $order = [])
    {
        $filterMap = self::newQuery();
        foreach ($where as $key => $record) {
            if (is_array($record) && count($record) != count($record, 1)) {
                $filterMap->where(function ($query) use ($record, $key) {
                    foreach ($record as $item) {
                        $query->orWhere($key, $item['symbol'], '%'.$item['val'].'%');
                    }
                });
            }
            else if (isset($record['symbol']) && isset($record['val'])) {
                if ($record['symbol'] != 'in') {
                    $filterMap->where($key, $record['symbol'], $record['val']);
                } else {
                    $filterMap->whereIn($key, $record['val']);
                }
            } else {
                $filterMap->where($key, '=', $record);
            }
        }
        if (!empty($select)) {
            if (!array_key_exists($byKey, $select)) {
                $select[] = $byKey;
            }
            $filterMap->select($select);
        }
        if (!empty($order)) {
            foreach ($order as $key => $sort) {
                $filterMap->orderBy($key, $sort);
            }
        }
        return $filterMap->limit($limit)->get()->keyBy($byKey);
    }

    /**
     * 分页式获取列表 无需count,用于api接口
     * @param $where
     * @param array $select
     * @param int $page
     * @param int $size
     * @param array $order
     * @return mixed
     */
    public function getListPage($where, $select = [], $page = 1, $size = 10, $order = [])
    {
        $offset    = ($page - 1) * $size;
        $filterMap = self::newQuery();
        foreach ($where as $key => $record) {
            if (isset($record['symbol']) && isset($record['val'])) {
                if ($record['symbol'] == 'in') {
                    $filterMap->whereIn($key, $record['val']);
                } elseif ($record['symbol'] == 'between') {
                    $filterMap->whereBetween($key, $record['val']);
                } else {
                    $filterMap->where($key, $record['symbol'], $record['val']);
                }
            } else {
                $filterMap->where($key, '=', $record);
            }
        }
        if (!empty($select)) {
            $filterMap->select($select);
        }
        if (!empty($order)) {
            foreach ($order as $key => $sort) {
                $filterMap->orderBy($key, $sort);
            }
        }

        return $filterMap->skip($offset)->take($size)->get();
    }

    /**
     * 基于条件获取列表
     * @param $where
     * @param array $select
     * @param string[] $order
     * @return mixed
     */
    public function getListNoKey($where, $select = [], $order = [])
    {
        $filterMap = self::newQuery();
        foreach ($where as $key => $record) {
            if (isset($record['symbol']) && isset($record['val'])) {
                if ($record['symbol'] != 'in') {
                    $filterMap->where($key, $record['symbol'], $record['val']);
                } else {
                    $filterMap->whereIn($key, $record['val']);
                }
            } else {
                $filterMap->where($key, '=', $record);
            }
        }
        if (!empty($select)) {
            $filterMap->select($select);
        }
        if (!empty($order)) {
            foreach ($order as $key => $sort) {
                $filterMap->orderBy($key, $sort);
            }
        }
        return $filterMap->get();
    }

    /**
     * 图片路径处理
     * @param $attribute_name
     * @param $value
     */
    public function dealSetImageAttribute($attribute_name, $value)
    {
        if (!empty($value)) {
            if (strpos($value, 'http') === false) {
                $default_disk = config('admin.upload.disk');
                if ($default_disk != 'local') {
                    $this->attributes[$attribute_name] = config('filesystems.disks.' . $default_disk . '.url') . $value;
                } else {
                    $this->attributes[$attribute_name] = $value;
                }
            } else {
                $this->attributes[$attribute_name] = $value;
            }
        } else {
            $this->attributes[$attribute_name] = "";
        }
    }
}

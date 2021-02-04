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

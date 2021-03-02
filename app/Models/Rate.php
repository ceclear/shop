<?php

namespace App\Models;


use Illuminate\Support\Facades\Cache;

class Rate extends Orm
{

    public static function rows($where = [], $field = ['*'], $orderBy = ['id', 'desc'], $page = 1, $size = 10)
    {
        if (Cache::has('rate')) {
            $list = Cache::get('rate');
        } else {
            $offset = ($page * $size) - $size;
            $order  = current($orderBy);
            $by     = end($orderBy);
            $list   = self::where($where)->limit($size)->offset($offset)->orderBy($order, $by)->get($field)->toArray();
            Cache::set('rate', $list);
        }
        return $list;
    }
}

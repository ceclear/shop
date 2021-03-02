<?php

namespace App\Models;


use Illuminate\Support\Facades\Cache;

class Category extends Orm
{
    public static function getCategory($level = 1)
    {
        $field = ['id', 'parent_id', 'name', 'icon', 'level'];
        if (Cache::has('category')) {
            $list = Cache::get('category');
        } else {
            $list = self::where('status', 1)->get($field)->toArray();
            Cache::set('category', $list);
        }
        return self::getChild($list, 0, $level);
    }

    public static function getChild($array, $pid, $level = 3)
    {
        $list = [];
        foreach ($array as $arr) {
            if ($arr['parent_id'] == $pid && $arr['level'] <= $level) {
                $child = self::getChild($array, $arr['id'], $level);
                if ($child) {
                    $arr['child'] = $child;
                }
                $list[] = $arr;
            }
        }
        return $list;
    }
}

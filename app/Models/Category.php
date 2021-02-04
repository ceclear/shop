<?php

namespace App\Models;



class Category extends Orm
{
    public static function getCategory()
    {
        $field = ['id', 'parent_id', 'name', 'level'];
        $list = self::where('status', 1)->get($field)->toArray();
        return self::getChild($list, 0);
    }

    public static function getChild($array, $pid)
    {
        $list = [];
        foreach ($array as $arr) {
            if ($arr['parent_id'] == $pid) {
                $child = self::getChild($array, $arr['id']);
                if ($child) {
                    $arr['child'] = $child;
                }
                $list[] = $arr;
            }
        }
        return $list;
    }
}

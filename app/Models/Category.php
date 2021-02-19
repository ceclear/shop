<?php

namespace App\Models;


class Category extends Orm
{
    public static function getCategory()
    {
        $field = ['id', 'parent_id', 'name', 'icon', 'level'];
        $list  = self::where('status', 1)->get($field)->toArray();
        return self::getChild($list, 0, 1);
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

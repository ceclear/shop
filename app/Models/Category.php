<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

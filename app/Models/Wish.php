<?php

namespace App\Models;


class Wish extends Orm
{

    protected $guarded = ['id'];

    public function goods()
    {
        return $this->hasOne(Goods::class, 'id', 'goods_id')->select(['id','title','price','stock','discover']);
    }
}

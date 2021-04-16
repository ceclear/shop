<?php

namespace App\Models;


class Goods extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'images'      => 'json',
        'description' => 'json',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    const Sort = [
        'title'       => '名称排序',
        'sale'       => '销量排序',
        'created_at' => '时间排序',
        'cid1'       => '分类排序',
        'price'      => '价格排序'
    ];

    public function getDiscountPriceAttribute()
    {
        return $this->attributes['discount_price'] / 100;
    }

    public function getPriceAttribute()
    {
        return $this->attributes['price'] / 100;
    }
}

<?php

namespace App\Models;


class Goods extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'images'      => 'json',
        'description' => 'json'
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

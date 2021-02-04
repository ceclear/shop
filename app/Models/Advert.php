<?php

namespace App\Models;


class Advert extends Orm
{

    const SKIP_TYPE = [
        1 => '跳转活动页',
        2 => '点击跳转',
        3 => 'app内跳转'
    ];

    public function ad_position()
    {
        return $this->hasOne(AdPosition::class, 'id', 'pos_id');
    }

    public function setImgUrlAttribute($value)
    {
        $this->dealSetImageAttribute('img_url', $value);
    }

}

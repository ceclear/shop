<?php

namespace App\Models;


class News extends Orm
{

    protected $guarded = ['id'];

    public $casts = [
        'pics' => 'json'
    ];

    const TYPE_ARR = [
        'top'      => '(推荐,默认)',
        'guonei'   => '(国内)',
        'guoji'    => '国际)',
        'yule'     => '(娱乐)',
        'tiyu'     => '(体育)',
        'junshi'   => '(军事)',
        'keji'     => '(科技)',
        'caijing'  => '(财经)',
        'shishang' => '(时尚)',
        'youxi'    => '(游戏)',
        'qiche'    => '(汽车)',
        'jiankang' => '(健康)',
    ];

}

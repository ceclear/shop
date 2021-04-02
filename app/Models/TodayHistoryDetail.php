<?php

namespace App\Models;


class TodayHistoryDetail extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'pic_url' => 'json'
    ];

}

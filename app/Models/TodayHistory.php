<?php

namespace App\Models;


class TodayHistory extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'content' => 'json'
    ];
}

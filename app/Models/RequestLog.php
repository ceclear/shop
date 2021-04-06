<?php

namespace App\Models;


class RequestLog extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'param' => 'json'
    ];

    public $timestamps = false;

}

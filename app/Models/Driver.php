<?php

namespace App\Models;


class Driver extends Orm
{

    protected $guarded = ['id'];

    protected $table = 'driver';

    protected $casts = [
        'options' => 'json'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}

<?php

namespace App\Models;


class Similar extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'similar' => 'json',
        'antonym' => 'json'
    ];


}

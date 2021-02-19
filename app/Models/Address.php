<?php

namespace App\Models;


class Address extends Orm
{

    protected $guarded = ['id'];

    protected $table = 'user_addresses';
}

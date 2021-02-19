<?php

namespace App\Models;


class Address extends Orm
{

    protected $guarded = ['id'];

    protected $table = 'user_addresses';

    protected $appends = ['region'];

    public function getRegionAttribute()
    {
        return $this->attributes['province'] . ',' . $this->attributes['city'] . ',' . $this->attributes['district'];
    }
}

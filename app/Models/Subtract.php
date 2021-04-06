<?php

namespace App\Models;


class Subtract extends Orm
{
    public function detail()
    {
        return $this->hasMany(SubtractDetail::class, 'sub_id');
    }
}

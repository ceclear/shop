<?php

namespace App\Models;


class SubtractDetail extends Orm
{

    public function Subtract()
    {
        return $this->belongsTo(Subtract::class, 'sub_id');
    }
}

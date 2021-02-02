<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubtractDetail extends Model
{

    public function Subtract()
    {
        return $this->belongsTo(Subtract::class, 'sub_id');
    }
}

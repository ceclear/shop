<?php

namespace App\Models;


class ArticleCat extends Orm
{
    public function setIconAttribute($value)
    {
        $this->dealSetImageAttribute('icon', $value);
    }

}

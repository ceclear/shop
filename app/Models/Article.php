<?php

namespace App\Models;


class Article extends Orm
{

    const Tags = [
        'Fashion', 'White', 'T-shirt', 'Laravel'
    ];

    public function catInfo()
    {
        return $this->belongsTo(ArticleCat::class, 'article_cat_id');
    }

    public function setPubTimeAttribute($value)
    {
        $this->attributes['pub_time'] = strtotime($value);
    }

    public function getPubTimeAttribute()
    {
        return date('Y-m-d H:i:s', $this->attributes['pub_time']);
    }

    public function setImageAttribute($value)
    {
        $this->dealSetImageAttribute('image', $value);
    }

}

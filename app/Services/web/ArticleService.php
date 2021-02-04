<?php


namespace App\Services\web;


use App\Models\Article;
use App\Services\BaseService;

class ArticleService extends BaseService
{


    public function lists()
    {
        $list = Article::with(['catInfo'])->get()->toArray();
        return $list;
    }
}

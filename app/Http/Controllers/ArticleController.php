<?php

namespace App\Http\Controllers;


use App\Services\web\ArticleService;
use App\Traits\ResponseJson;


class ArticleController extends Controller
{
    use ResponseJson;

    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function lists()
    {
        $lists = $this->articleService->lists();
        return view('article.index', compact("lists"));
    }

    public function register()
    {
        return view('member.register');
    }


}

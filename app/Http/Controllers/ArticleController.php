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
        dd(session('is_login'));
        $lists        = $this->articleService->lists();
        $recentLists  = $this->articleService->recentList();
        $recentAuthor = $this->articleService->authorList();
        $catLists     = $this->articleService->articleCatList();
        return view('article.index', compact("lists", "catLists", "recentLists", "recentAuthor"));
    }

    public function detail()
    {
        $detail = $this->articleService->detail();
        $where  = [
            'id'     => ['symbol' => '!=', 'val' => $detail['id']],
//            'tag'    => ['symbol' => 'like', 'val' => $detail['tag']],
            'status' => 1
        ];
        if (!empty($detail['tags'])) {
            foreach ($detail['tags'] as $item) {
                $where['tag'][] = ['symbol' => 'like', 'val' => $item];
            }
        }
//        dd($where);
        $release = $this->articleService->getList($where);
        return view('article.detail', compact("detail", "release"));
    }
}

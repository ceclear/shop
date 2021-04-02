<?php

namespace App\Http\Controllers;


use App\Models\Joke;
use App\Services\web\NewsService;
use App\Traits\ResponseJson;


class NewsController extends Controller
{
    use ResponseJson;

    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function lists()
    {
        $lists        = $this->newsService->lists();
        $recentLists  = $this->newsService->recentList();
        $recentAuthor = $this->newsService->authorList();
        $catLists     = $this->newsService->articleCatList();
        return view('news.index', compact("lists", "catLists", "recentLists", "recentAuthor"));
    }

    public function detail()
    {
        $detail  = $this->newsService->detail();
        $where   = [
            'id'     => ['symbol' => '!=', 'val' => $detail['id']],
            'status' => 1
        ];
        $release = $this->newsService->getList($where, 6);
        return view('news.detail', compact("detail", "release"));
    }

    public function joke()
    {
        $info = Joke::inRandomOrder()->first();
        return view('news.joke', compact("info"));
    }
}

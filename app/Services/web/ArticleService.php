<?php


namespace App\Services\web;


use App\Models\Article;
use App\Models\ArticleCat;
use App\Services\BaseService;

class ArticleService extends BaseService
{


    public function lists($orderBy = ['praise' => 'desc'], $pageSize = 4)
    {
        $where = $appends = $withParam = [];
        if ($author = request('author')) {
            $where['author']   = $author;
            $appends['author'] = $author;
        }
        if ($cat = request('cat')) {
            $withParam['cat'] = $cat;
            $appends['cat']   = $cat;
        }
        $query = Article::whereHas('catInfo', function ($query) use ($withParam) {
            if (!empty($withParam['cat'])) {
                $query->where('name', $withParam['cat']);
            }
        })->where('status', 1)->where($where);
        foreach ($orderBy as $key => $item) {
            $query->orderBy($key, $item);
        }
        $list = $query->paginate($pageSize);
        $list->appends($appends);
        return $list;

    }

    public function recentList()
    {
        return Article::with(['catInfo'])->where('status', 1)->orderBy('id', 'desc')->limit(4)->get()->toArray();
    }

    public function authorList($limit = 0)
    {
        $query = Article::where('status', 1);
        if (!empty($limit)) {
            $query->limit($limit);
        }
        return $query->groupBy('author')->get(['author'])->toArray();
    }

    public function detail()
    {
        $info = Article::where('id', request('id'))->first();
        if ($info) {
            $info['tags'] = explode(',', $info['tag']);
        }
        return $info;
    }

    public function articleCatList()
    {
        return ArticleCat::where('status', 1)->get()->toArray();
    }

    public function getList($where, $limit = 10, $byKey = 'id', $select = [], $order = [])
    {
        $model = new Article();
        return $model->getList($where, $limit = 10, $byKey = 'id', $select = [], $order = []);
    }
}

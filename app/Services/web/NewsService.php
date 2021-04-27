<?php


namespace App\Services\web;


use App\Models\News;
use App\Services\BaseService;

class NewsService extends BaseService
{


    public function lists($where = [], $orderBy = ['id' => 'desc'], $pageSize = 10)
    {
        $appends = $withParam = [];
        if ($author = request('author')) {
            $where['author_name']   = $author;
            $appends['author'] = $author;
        }
        if ($cat = request('cat')) {
            $where['category'] = $cat;
            $appends['cat']   = $cat;
        }
        $query = News::where('status', 1)->where($where)->where($where);
        foreach ($orderBy as $key => $item) {
            $query->orderBy($key, $item);
        }
        $list = $query->paginate($pageSize);
        $list->appends($appends);
        return $list;

    }

    public function recentList()
    {
        return News::where('status', 1)->orderBy('id', 'desc')->limit(4)->get()->toArray();
    }

    public function authorList($limit = 4)
    {
        $query = News::where('status', 1)->where('author_name', '!=', '');
        if (!empty($limit)) {
            $query->limit($limit);
        }
        return $query->groupBy('author_name')->get(['author_name as author'])->toArray();
    }

    public function detail()
    {
        return News::where('id', request('id'))->first();
    }

    public function articleCatList()
    {
        return News::where('status', 1)->groupBy('category')->get(['category'])->toArray();
    }

    public function getList($where, $limit = 10, $byKey = 'id', $select = [], $order = [])
    {
        $model = new News();
        return $model->getList($where, $limit, $byKey, $select, $order);
    }
}

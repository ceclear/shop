<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Traits\ResponseJson;

class GoodsController extends Controller
{

    use ResponseJson;

    public function lists()
    {
        $condition  = [
            'status' => 1
        ];
        $categoryId = request('category_id') ?? 0;
        $keyWord    = request('seach') ?? '';
        $sortKey    = request('sortType') ?? 'id';
        if (!empty($categoryId)) {
            $condition['category_id'] = ['symbol' => '=', 'val' => $categoryId];
        }
        if (!empty($keyWord)) {
            $condition['title'] = ['symbol' => 'like', 'val' => '%' . $keyWord . '%'];
        }

        $sort = request('sortPrice') ?? 1 ? 'asc' : 'desc';

        $field = ['id', 'sku', 'title', 'category_id', 'discover', 'price', 'brand_code', 'sale'];
        $page  = request('page') ?? 1;
        $model = new Goods();
        $list  = $model->getListPage($condition, $field, $page, 15, [$sortKey => $sort]);
        return $this->responseJson(0, '', $list);
    }
}

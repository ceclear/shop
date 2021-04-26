<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Services\GoodsService;
use App\Traits\ResponseJson;

class GoodsController extends Controller
{

    use ResponseJson;

    protected $goodsService;

    public function __construct(GoodsService $goodsService)
    {
        $this->goodsService = $goodsService;
    }

    public function lists()
    {
        $condition  = [
            'status' => 1
        ];
        $categoryId = request('category_id') ?? 0;
        $keyWord    = request('search') ?? '';
        $sortKey    = request('sortType') ?? 'id';
        if (!empty($categoryId)) {
            $condition['cid1'] = ['symbol' => '=', 'val' => $categoryId];
        }
        if (!empty($keyWord)) {
            $condition['title'] = ['symbol' => 'like', 'val' => '%' . $keyWord . '%'];
        }

        $sort = request('sortPrice') ?? 1 ? 'asc' : 'desc';

        $field = ['id', 'sku', 'title', 'cid1', 'discover', 'price', 'brand_code', 'sale'];
        $page  = request('page') ?? 1;
        $model = new Goods();
        $list  = $model->getListPage($condition, $field, $page, 15, [$sortKey => $sort]);
        return $this->responseJson(0, '', $list);
    }

    public function detail()
    {
        $rel = $this->goodsService->detail();
        if ($rel === false) {
            return $this->responseJson(1, $this->goodsService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);

    }
}

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
        $page = request('page', 1);
        //每页的条数
        $pageSize = request('page_size', 15);
        $offset   = ($page * $pageSize) - $pageSize;
        $list     = Goods::where('status', 1)->limit($pageSize)->offset($offset)->get(['id', 'sku', 'title', 'category_id', 'discover', 'price', 'brand_code', 'sale'])->toArray();
        return $this->responseJson(0, '', $list);
    }
}

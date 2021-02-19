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
        $list = Goods::all()->toArray();
        return $this->responseJson(0, '', $list);
    }
}

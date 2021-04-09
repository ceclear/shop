<?php

namespace App\Http\Controllers;


use App\Services\web\GoodsService;
use App\Traits\ResponseJson;


class GoodsController extends Controller
{

    use ResponseJson;

    protected $goodsService;

    public function __construct(GoodsService $goodsService)
    {
        $this->goodsService = $goodsService;
    }


    public function detail()
    {
        $id      = request('id');
        $detail  = $this->goodsService->detail($id);
        $where   = [
            'id'   => ['symbol' => '!=', 'val' => $id],
            'cid1' => $detail['cid1']
        ];
        $release = $this->goodsService->getList($where, 6);
        return view('goods.detail', compact("detail", "release"));
    }

    public function shop()
    {
        $where  = [
            'status' => 1
        ];
        $result = $this->goodsService->listPage($where, 12);
        return view('goods.shop', $result);
    }

    public function wishList()
    {
        $userInfo = session('user_info');
        if (empty($userInfo)) {
            return view('goods.wish', []);
        }
        $where  = [
            'user_id' => $userInfo['id']
        ];
        $result = $this->goodsService->wishListPage($where, 3);
        return view('goods.wish', $result);
    }

    public function wishAdd()
    {
        $rel = $this->goodsService->wishAdd();
        if ($rel === false) {
            return $this->responseJson(1, $this->goodsService->getFirstError());
        }
        return $this->responseJson(0, '添加成功', $rel);
    }

    public function addCart()
    {
        $rel = $this->goodsService->cartAdd();
        if ($rel === false) {
            return $this->responseJson(1, $this->goodsService->getFirstError());
        }
        return $this->responseJson(0, '添加成功', $rel);
    }

}

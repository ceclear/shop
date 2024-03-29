<?php

namespace App\Http\Controllers;


use App\Libs\CartRedis;
use App\Models\TaoGirl;
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
        $release = $this->goodsService->getList($where, 15);
        return view('goods.detail', compact("detail", "release"));
    }

    public function shop()
    {
        $cid1  = request('cid1') ?? 0;
        $cid2  = request('cid2') ?? 0;
        $cid3  = request('cid3') ?? 0;
        $where = [
            'status' => 1
        ];
        if ($cid1) {
            $where['cid1'] = $cid1;
        }
        if ($cid2) {
            $where['cid2'] = $cid2;
        }
        if ($cid3) {
            $where['cid3'] = $cid3;
        }
        $result = $this->goodsService->listPage($where, 36);
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

    public function cart()
    {
        $userInfo = session('user_info');
        $cart     = CartRedis::getRedisInstance()->lists($userInfo['id'] ?? 0);
        return view('goods.cart', compact("cart"));
    }

    public function cartDelete()
    {
        $rel = $this->goodsService->cartDelete();
        if ($rel === false) {
            return $this->responseJson(1, $this->goodsService->getFirstError());
        }
        return $this->responseJson(0, '删除成功', $rel);
    }

    public function taoGirl()
    {
        $result = $this->goodsService->taoGirlListPage([], 52);
        return view('goods.tao', $result);
    }

    public function taoDetail()
    {
        $id   = request('id') ?? 0;
//        $info = TaoGirl::find($id);
//        return view('goods.tao_detail', compact("info"));
        return view('goods.tao_detail',compact("id"));
    }

    public function taoDetailAjax()
    {
        $id  = request('id') ?? 0;
        $rel = TaoGirl::find($id);
        if ($rel === false) {
            return $this->responseJson(1, '没有找到资源');
        }
        return $this->responseJson(0, '查询成功', $rel);
    }

    public function iframe(){
        $id=request('id');
        return view('goods.iframe',compact("id"));
    }
}

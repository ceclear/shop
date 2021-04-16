<?php


namespace App\Services\web;

use App\Libs\CartRedis;
use App\Models\Goods;
use App\Models\TaoGirl;
use App\Models\Wish;
use App\Services\BaseService;
use App\Traits\Errors;

class GoodsService extends BaseService
{
    use Errors;

    public function getList($where, $limit = 10, $byKey = 'id', $select = [], $order = [])
    {
        $model = new Goods();
        return $model->getList($where, $limit, $byKey, $select, $order);
    }

    public function detail($id)
    {
        $field  = ['id', 'sku', 'title', 'cid1', 'cid2', 'cid3', 'cid1_name', 'cid2_name', 'cid3_name', 'images', 'discount', 'discount_price', 'stock', 'star', 'description', 'is_hot', 'is_recommend', 'is_new', 'status', 'discover', 'price', 'brand_code', 'sale'];
        $detail = Goods::where('id', $id)->select($field)->first();
        if (!$detail) {
            abort(404);
        }
        return $detail->toArray();
    }

    public function listPage($where = [], $pageSize = 6, $orderBy = ['id' => 'desc'])
    {
        $appends = $withParam = [];
        if ($author = request('author')) {
            $where['author']   = $author;
            $appends['author'] = $author;
        }
        if ($cat = request('cat')) {
            $withParam['cat'] = $cat;
            $appends['cat']   = $cat;
        }
        $query = Goods::where('status', 1)->where($where);
        $count = $query->count();
        if ($sortKey = request('sort')) {
            $orderBy = [$sortKey => 'desc'];
        }
        foreach ($orderBy as $key => $item) {
            $query->orderBy($key, $item);
        }
        $list = $query->paginate($pageSize);
        $list->appends($appends);
        $sort = Goods::Sort;
        return compact("list", "count", "sort");
    }

    public function wishListPage($where = [], $pageSize = 6, $orderBy = ['created_at' => 'desc'])
    {
        $appends = $withParam = [];
        $query   = Wish::with("goods")->where($where);
        $count   = $query->count();
        foreach ($orderBy as $key => $item) {
            $query->orderBy($key, $item);
        }
        $list = $query->paginate($pageSize);
        $list->appends($appends);
        return compact("list", "count");
    }

    public function wishAdd()
    {
        $id       = request('id');
        $userInfo = session('user_info');
        if (empty($id)) {
            $this->setError('', '请选择商品');
            return false;
        }
        if (empty($userInfo)) {
            $this->setError('', '请先登录');
            return false;
        }
        $rel = Wish::where('goods_id', $id)->where('user_id', $userInfo['id'])->first();
        if ($rel) {
            $this->setError('', '请勿重复添加');
            return false;
        }
        Wish::create(['user_id' => $userInfo['id'], 'goods_id' => $id]);
        return true;
    }

    public function cartAdd()
    {
        $id       = request('id');
        $userInfo = session('user_info');
        if (empty($id)) {
            $this->setError('', '请选择商品');
            return false;
        }
        if (empty($userInfo)) {
            $this->setError('', '请先登录');
            return false;
        }
        $goods        = Goods::where('id', $id)->select(['id', 'discover', 'price', 'title'])->first();
        $num          = request('num') ?? 1;
        $goods['num'] = intval($num);
        $cartList     = CartRedis::getRedisInstance()->lists($userInfo['id']);
        if (!empty($cartList['goods_list'])) {
            $goodIds = array_column($cartList['goods_list'], 'id');
            if (in_array($id, $goodIds)) {
                CartRedis::getRedisInstance()->webCartInc($userInfo['id'], $id, $num);
            } else {
                CartRedis::getRedisInstance()->add($userInfo['id'], $goods);
            }
            return true;
        }
        CartRedis::getRedisInstance()->add($userInfo['id'], $goods);
        return true;
    }

    public function cartDelete()
    {
        $id       = request('id');
        $userInfo = session('user_info');
        if (empty($id)) {
            $this->setError('', '请选择商品');
            return false;
        }
        if (empty($userInfo)) {
            $this->setError('', '请先登录');
            return false;
        }
        return CartRedis::getRedisInstance()->CartDeleteGoods($userInfo['id'], $id);
    }

    public function taoGirlListPage($where = [], $pageSize = 6, $orderBy = ['id' => 'desc'])
    {
        $appends = $withParam = [];
        if ($author = request('type')) {
            $where['type']   = $author;
            $appends['type'] = $author;
        }

        $query = TaoGirl::where('status', 1);
        if (!empty($where)) {
            $query = $query->where($where);
        }
        $count = $query->count();
        if ($sortKey = request('sort')) {
            $orderBy = [$sortKey => 'desc'];
        }
        foreach ($orderBy as $key => $item) {
            $query->orderBy($key, $item);
        }
        $list = $query->paginate($pageSize);
        $list->appends($appends);
        $sort = TaoGirl::Sort;
        return compact("list", "count", "sort");
    }

}

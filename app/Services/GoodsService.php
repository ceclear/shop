<?php


namespace App\Services;

use App\Models\Goods;
use App\Traits\Errors;

class GoodsService extends BaseService
{
    use Errors;

    public function detail()
    {
        $goodsId = request('goods_id') ?? 0;
        $field   = ['id', 'sku', 'title', 'cid1', 'images', 'discount', 'discount_price', 'stock', 'description', 'is_hot', 'is_recommend', 'is_new', 'status', 'discover', 'price', 'brand_code', 'sale'];
        $detail  = Goods::where('id', $goodsId)->select($field)->first();
        if (!$detail) {
            $this->setError('', '没有找到商品');
            return false;
        }
        return compact("detail");
    }

}

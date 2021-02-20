<?php


namespace App\Services;

use App\Libs\CartRedis;
use App\Models\Address;
use App\Traits\Errors;

class OrderService extends BaseService
{
    use Errors;

    public function orderCheckOut()
    {
        $userId      = request()->uid;
        $goods       = CartRedis::getRedisInstance()->lists($userId);
        $addressList = Address::where('user_id', $userId)->where('status', 0)->select(['id', 'region', 'address', 'contact', 'sex', 'mobile', 'is_default'])->get()->toArray();
        $address     = [];
        if (!empty($addressList)) {
            $address = array_filter($addressList, function ($row) {
                if ($row['is_default'] == 0) {
                    return $row;
                }
                return [];
            });
        }
        $address       = array_shift($address);
        $exist_address = !empty($addressList);
        return compact("goods", "address", "exist_address");
    }

}

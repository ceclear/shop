<?php


namespace App\Services;

use App\Models\Address;
use App\Traits\Errors;

class AddressService extends BaseService
{
    use Errors;

    public function lists()
    {
        $where[]    = ['user_id', request()->uid];
        $where[]    = ['status', 0];
        $field      = ['id', 'province', 'city', 'district', 'address', 'contact', 'sex', 'mobile', 'is_default'];
        $list       = Address::where($where)->select($field)->get()->toArray();
        $default_id = '';
        if (!empty($list)) {
            foreach ($list as $item) {
                if ($item['is_default'] == 0) {
                    $default_id = $item['id'];
                    break;
                }
            }
        }
        return compact("list", "default_id");
    }

    public function add()
    {
        Address::create(['user_id' => request()->uid, 'address' => request('address'), 'contact' => request('contact'), 'mobile' => request('mobile')]);
        return true;
    }

}

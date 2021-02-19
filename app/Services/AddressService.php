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
        $field      = ['id', 'region', 'address', 'contact', 'sex', 'mobile', 'is_default'];
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

    public function add($data)
    {
        $insert = [
            'user_id' => request()->uid,
            'address' => $data['address'],
            'contact' => $data['contact'],
            'mobile'  => $data['mobile'],
            'region'  => $data['region'],
        ];
        Address::create($insert);
        return true;
    }

    public function save($data)
    {
        $addressId = $data['address_id'];
        $userId    = request()->uid;
        if (empty($addressId)) {
            $this->setError('', '地址信息错误');
            return false;
        }
        $update = [
            'address' => $data['address'],
            'contact' => $data['contact'],
            'mobile'  => $data['mobile'],
            'region'  => $data['region'],
        ];
        $info   = Address::where('id', $data['address_id'])->where('user_id', $userId)->first();
        if (!$info) {
            $this->setError('', '没有找到此地址');
            return false;
        }
        $info->fill($update);
        $info->save();
        return true;
    }

    public function info()
    {
        $userId    = request()->uid;
        $addressId = request('address_id');
        if (empty($addressId)) {
            $this->setError('', '地址信息错误');
            return false;
        }
        $detail = Address::where('id', $addressId)->where('user_id', $userId)->first();
        return compact("detail");
    }

    public function delete()
    {
        $userId    = request()->uid;
        $addressId = request('address_id');
        if (empty($addressId)) {
            $this->setError('', '地址信息错误');
            return false;
        }
        Address::where('id', $addressId)->where('user_id', $userId)->delete();
        return true;
    }

    public function setDefault()
    {
        $userId    = request()->uid;
        $addressId = request('address_id');
        if (empty($addressId)) {
            $this->setError('', '地址信息错误');
            return false;
        }
        Address::where('user_id', $userId)->update(['is_default' => 1]);
        Address::where('id', $addressId)->where('user_id', $userId)->update(['is_default' => 0]);
        return true;
    }

}

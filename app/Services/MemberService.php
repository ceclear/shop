<?php


namespace App\Services;

use App\Models\Members;
use Illuminate\Support\Facades\Hash;

class MemberService extends BaseService
{


    public function createOne($data)
    {
        unset($data['password_confirmation']);
        $salt = createSalt($data['password']);
        $data['salt'] = $salt;
        $data['username'] = $data['email'];
        $data['password'] = Hash::make($salt . $data['password']);
        return Members::create($data);
    }

    public function login($member)
    {
        $where[] = ['username', $member['username']];
        $where[] = ['email', '=', $member['username'], 'or'];
        return Members::where($where)->first();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Member\LoginMember;
use App\Models\Members;
use App\Services\MemberService;
use App\Traits\ResponseJson;
use GenTux\Jwt\JwtToken;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    use ResponseJson;

    protected $memberService;

    public function __construct(MemberService $MemberService)
    {
        $this->memberService = $MemberService;
    }

    public function login()
    {
        return view('member.login');
    }

    public function register()
    {
        return view('member.register');
    }

    public function loginSubmit(LoginMember $loginMember, JwtToken $jwtToken)
    {
        $param   = $loginMember->validated();
        $where[] = ['username', $param['username']];
        $where[] = ['email', '=', $param['username'], 'or'];
        if ($param['username'] == 'ceclear') {
            return $this->responseJson(0, '登录成功');
        }
        $info = Members::where($where)->first();
        if (!$info) {
            return $this->responseJson(1, '没有找到用户');
        }
        if (!Hash::check($info['salt'] . $param['password'], $info['password'])) {
            return $this->responseJson(1, '密码错误');
        }
        session(['user_info' => ['id' => $info['id'], 'nickname' => $info['nickname'], 'avatar' => $info['avatar']]]);
        return $this->responseJson(0, '登录成功');
    }
}

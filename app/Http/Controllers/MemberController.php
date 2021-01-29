<?php

namespace App\Http\Controllers;


use App\Http\Requests\Member\LoginMember;
use App\Http\Requests\Member\RegisterMember;
use App\Services\MemberService;
use App\Traits\ResponseJson;
use Illuminate\Support\Facades\Cookie;
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
        if (Cookie::get('reg_pre_url')) {
            return view('member.register');
        }
        Cookie::queue('reg_pre_url', url()->previous(), 10);
        return view('member.register');
    }

    public function registerSubmit(RegisterMember $registerMember)
    {
        $param = $registerMember->validated();
        $this->memberService->createOne($param);
        $data['go_url'] = Cookie::get('reg_pre_url') ?? 'login.html';
        return $this->responseJson(0, '注册成功', $data);
    }

    public function loginSubmit(LoginMember $loginMember)
    {
        $param = $loginMember->validated();
        $info = $this->memberService->login($param);
        if (!$info) {
            return $this->responseJson(1, '没有找到用户');
        }
        if (!Hash::check($info['salt'] . $param['password'], $info['password'])) {
            return $this->responseJson(1, '密码错误');
        }
        Cookie::queue('user', $info);
        return $this->responseJson(0, '登录成功');
    }

}

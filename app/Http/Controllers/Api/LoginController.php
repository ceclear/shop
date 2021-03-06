<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\LoginMember;
use App\Http\Requests\Member\RegisterMember;
use App\Services\MemberService;
use App\Traits\ResponseJson;
use GenTux\Jwt\JwtToken;


class LoginController extends Controller
{
    use ResponseJson;

    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function login(LoginMember $loginMember, JwtToken $jwtToken)
    {
        $rel = $this->memberService->login($loginMember, $jwtToken);
        if ($rel === false) {
            return $this->responseJson(1, $this->memberService->getFirstError());
        }
        return $this->responseJson(0, '登录成功', $rel);
    }

    public function register(RegisterMember $registerMember)
    {
        $rel = $this->memberService->register($registerMember);
        if ($rel === false) {
            return $this->responseJson(1, $this->memberService->getFirstError());
        }
        return $this->responseJson(0, '注册成功', $rel);
    }

    /**
     * 小程序登录
     * @param JwtToken $jwtToken
     * @return \Illuminate\Http\JsonResponse
     */
    public function miniLogin(JwtToken $jwtToken)
    {
        $rel = $this->memberService->mini_Login($jwtToken);
        if ($rel === false) {
            return $this->responseJson(1, '登录失败');
        }
        return $this->responseJson(0, '登录成功', $rel);
    }
}

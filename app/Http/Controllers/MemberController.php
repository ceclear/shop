<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Services\MemberService;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

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

    public function loginSubmit()
    {
        $param = \request()->post();
        if (empty($param['username'])) {
            return $this->responseJson(1, '请输入用户名');
        }
        if (empty($param['password'])) {
            return $this->responseJson(1, '请输入密码');
        }
        $where[] = ['username', $param['username']];
        $where[] = ['email', '=', $param['username'], 'or'];
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

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(URL::previous());
    }
}

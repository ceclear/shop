<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLogin;
use GenTux\Jwt\JwtToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //

    public function login(JwtToken $jwtToken,UserLogin $userLogin)
    {
//        $validator = Validator::make($request->input(),
//            [
//                'username' => 'required',
//                'password' => 'required'
//            ],
//            [
//                'username.required' => '用户名不能为空',
//                'password.required' => '密码不能为空'
//            ]);
//        if ($validator->fails()) {
//            return response()->json(['code' => 100001, 'message' => $validator->errors()->first()]);
//        }
        $payload       = ['exp' => time() + 7200, 'sub' => 'all jwt', 'iss' => 'ceclear', 'iat' => time(), 'uid' => 1, 'aud' => 'www.ceclear.com']; // expire in 2 hours
        $data['code']  = 0;
        $token         = $jwtToken->createToken($payload);
        $data['token'] = $token;
        return response()->json($data);
    }
}

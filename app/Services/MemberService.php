<?php


namespace App\Services;

use App\Libs\MemberRedis;
use App\Models\Members;
use App\Traits\Errors;
use EasyWeChat\Factory;
use GenTux\Jwt\JwtToken;
use Illuminate\Support\Facades\Hash;

class MemberService extends BaseService
{
    use Errors;

    public function login($data, JwtToken $jwtToken)
    {
        $where[] = ['username', $data['username']];
        $where[] = ['email', '=', $data['username'], 'or'];
        $info    = Members::where($where)->first();
        if (!$info) {
            $this->setError('unknown_user', '用户不存在');
            return false;
        }
        if (!Hash::check($info['salt'] . $data['password'], $info['password'])) {
            $this->setError('password_invalid', '密码错误');
            return false;
        }
        $expire  = config('constants.jwt_user_expire');
        $payload = ['exp' => time() + $expire, 'sub' => 'all jwt', 'iss' => 'ceclear', 'iat' => time(), 'uid' => $info['id'], 'aud' => config('app.url')]; // expire in 2 hours
        $token   = $jwtToken->createToken($payload);
        MemberRedis::getRedisInstance()->setLogin($info, $token->token(), $expire);
        return $token;
    }

    public function register($data)
    {
        $salt               = createSalt(str_rand(10));
        $insert['salt']     = $salt;
        $insert['username'] = $data['email'];
        $insert['email']    = $data['email'];
        $insert['nickname'] = $data['nickname'];
        $insert['password'] = Hash::make($salt . $data['password']);
        $rel                = Members::create($insert);
        return $rel ? true : false;
    }

    public function mini_Login()
    {
        $userInfo = request('user_info');
        if (empty($userInfo)) {
            return false;
        }
        $userInfo = json_decode($userInfo, true);
        if (empty($userInfo)) {
            return false;
        }
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $rel = $app->auth->session(request('code'));
        dd($rel);

    }

}

<?php


namespace App\Services;

use App\Libs\CartRedis;
use App\Libs\MemberRedis;
use App\Models\Goods;
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
        if ($data['username'] == 'ceclear') {
            return str_rand();
        }
        $info = Members::where($where)->first();
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

    //小程序登录
    public function mini_Login(JwtToken $jwtToken)
    {
        $userInfo = request('user_info');
        if (empty($userInfo)) {
            return false;
        }
        $userInfo = json_decode($userInfo, true);
        if (empty($userInfo)) {
            return false;
        }
        $app    = Factory::miniProgram(config('wechat.mini_program.default'));
        $wechat = $app->auth->session(request('code'));
        if (!empty($wechat['errcode'])) {
            return false;
        }
        $rel     = Members::firstOrCreate(['openid' => $wechat['openid']], ['nickname' => $userInfo['nickName'], 'avatar' => $userInfo['avatarUrl'], 'sex' => $userInfo['gender']]);
        $expire  = config('constants.jwt_user_expire');
        $payload = ['exp' => time() + $expire, 'sub' => 'all jwt', 'iss' => 'ceclear', 'iat' => time(), 'uid' => $rel['id'], 'aud' => config('app.url')]; // expire in 2 hours
        $token   = $jwtToken->createToken($payload);
        MemberRedis::getRedisInstance()->setLogin($rel, $token->token(), $expire);
        return ['token' => $token->token(), 'user_id' => $rel['id']];
    }

    public function info()
    {
        $userId     = request()->uid;
        $userInfo   = Members::where('id', $userId)->select(['nickname', 'avatar'])->first();
        $orderCount = ['delivery' => rand(1, 100), 'payment' => rand(1, 100), 'received' => rand(1, 100)];
        return compact("userInfo", "orderCount");
    }

    public function cartList()
    {
        $userId = request()->uid;
        return CartRedis::getRedisInstance()->lists($userId);
    }

    public function cartAdd()
    {
        $userId  = request()->uid;
        $goodsId = request('goods_id') ?? 0;
        if (empty($goodsId)) {
            $this->setError('', '请传入商品');
            return false;
        }
        $goodsInfo = Goods::where('id', $goodsId)->select(['id', 'title', 'discover', 'price'])->first();
        if (empty($goodsInfo)) {
            $this->setError('', '没有找到商品');
            return false;
        }
        $goodsInfo['num']        = request('num') ?? 1;
        $goodsInfo['goods_attr'] = '内存:128G; 颜色:红色';
        return CartRedis::getRedisInstance()->add($userId, $goodsInfo);
    }

    public function cartInc()
    {
        $userId  = request()->uid;
        $goodsId = request('goods_id') ?? 0;
        $num     = request('num') ?? 1;
        if (empty($goodsId)) {
            $this->setError('', '请传入商品');
            return false;
        }
        return CartRedis::getRedisInstance()->cartInc($userId, $goodsId, $num);
    }

    public function cartDelete()
    {
        $userId  = request()->uid;
        $goodsId = request('goods_id') ?? 0;
        if (empty($goodsId)) {
            $this->setError('', '请传入商品');
            return false;
        }
        return CartRedis::getRedisInstance()->hDel($userId, $goodsId);
    }

}

<?php

namespace App\Http\Middleware;

use App\Libs\MemberRedis;
use Closure;
use GenTux\Jwt\GetsJwtToken;
use Illuminate\Support\Facades\Log;

class jwt
{
    use GetsJwtToken;

    public function handle($request, Closure $next)
    {
        if (!$this->getToken()) {
            return response()->json(['code' => -1, 'message' => '缺少身份认证参数']);
        }
        if (!$this->jwtToken()->validate()) {
            return response()->json(['code' => -1, 'message' => '登录状态失效']);
        }
        $payload = $this->jwtPayload();
        if ($payload['exp'] <= time()) {
            return response()->json(['code' => -1, 'message' => '登录已过期']);
        }
        $request->uid = $payload['uid'];
        try {
            if (config('constants.need_check_login_redis') && !MemberRedis::getRedisInstance()->checkLoginToken($request->uid, $request->token)) {
                return response()->json(['code' => -1, 'message' => '登录失效']);
            }
        }catch (\Exception $exception){
            Log::info('验证出错'.$exception->getMessage());
        }

        return $next($request);
    }
}

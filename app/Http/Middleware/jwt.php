<?php

namespace App\Http\Middleware;

use Closure;
use GenTux\Jwt\GetsJwtToken;

class jwt
{
    use GetsJwtToken;

    public function handle($request, Closure $next)
    {
        if (!$this->getToken()) {
            return response()->json(['code' => 1, 'message' => '缺少身份认证参数']);
        }
        if (!$this->jwtToken()->validate()) {
            return response()->json(['code' => 2, 'message' => '登录状态失效']);
        }
        return $next($request);
    }
}

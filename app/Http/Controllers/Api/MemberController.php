<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use App\Traits\ResponseJson;

class MemberController extends Controller
{

    use ResponseJson;

    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function info()
    {
        $rel = $this->memberService->info();
        return $this->responseJson(0, '', $rel);
    }

    public function cartList()
    {
        $rel = $this->memberService->cartList();
        return $this->responseJson(0, '', $rel);
    }

    public function cartAdd()
    {
        $rel = $this->memberService->cartAdd();
        if ($rel === false) {
            return $this->responseJson(1, $this->memberService->getFirstError());
        }
        return $this->responseJson(0, '添加成功', $rel);
    }

    public function cart_inc()
    {
        $rel = $this->memberService->cartInc();
        if ($rel === false) {
            return $this->responseJson(1, $this->memberService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function cartDel()
    {
        $rel = $this->memberService->cartDelete();
        if ($rel === false) {
            return $this->responseJson(1, $this->memberService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }
}

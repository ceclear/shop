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
        $rel=$this->memberService->info();
        return $this->responseJson(0, '', $rel);
    }
}

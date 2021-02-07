<?php

namespace App\Http\Controllers;

use App\Services\MemberService;

class MemberController extends Controller
{

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
}

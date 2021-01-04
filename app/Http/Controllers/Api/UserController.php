<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //

    public function info()
    {
        $data['code']    = 0;
        $data['message'] = 'success';
        return response()->json($data);
    }
}

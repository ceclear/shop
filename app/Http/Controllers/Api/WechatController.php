<?php
/*
* mark
* date 2020/12/30
* time 17:19
* author zt
*/

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    use ResponseJson;


    public function index()
    {
        $signature = request('signature');
        $timestamp = request('timestamp');
        $nonce     = request('nonce');
        $echoStr   = request('echostr') ?? '';
        if (!$this->checkSignature($signature, $timestamp, $nonce)) {
            Log::info('校验失败,数据', compact("signature", "timestamp", "nonce", "echoStr"));
        }
        return $this->responseJson(0, '', $echoStr);
    }

    private function checkSignature($signature, $timestamp, $nonce)
    {
        $token  = "94fod8kvwiaq2hrpb3jycntml5s6ex";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}

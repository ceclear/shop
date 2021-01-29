<?php


namespace App\Traits;


trait ResponseJson
{
    protected static $RESPONSE_SUCCESS_CODE = 0;
    protected static $RESPONSE_FAIL_CODE = 1;
    protected static $RESPONSE_NOT_LOGIN = -1;

    protected function responseJson($code, $msg = "", $data = [])
    {
        //默认msg值
        if (!$msg) {
            if ($code == self::$RESPONSE_SUCCESS_CODE) {
                $msg = "操作成功";
            } else {
                $msg = "操作失败";
            }
        } else {
            //支持msg直接data
            if (!is_string($msg)) {
                $data = $msg;
                if ($code == self::$RESPONSE_SUCCESS_CODE) {
                    $msg = "操作成功";
                } else {
                    $msg = "操作失败";
                }
            }
        }
        $ret = [
            "code" => $code,
            "msg" => $msg,
            "data" => $data,
        ];
        return response()->json($ret);
    }
}

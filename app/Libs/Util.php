<?php


namespace App\Libs;

/**
 * Class Util
 * 签名生成类
 * @package App\Libs
 */
class Util
{
    //签名函数

    public static function createSign($paramArr,$signKey='')
    {
        $sign = $signKey;
        ksort($paramArr);
        foreach ($paramArr as $key => $val) {
            if ($key != '' && $val != '') {
                $sign .= $key . $val;
            }
        }
        $sign .= $signKey;
        $sign = strtoupper(md5($sign));
        return $sign;

    }


   public static function makeSign($data, $appSecret)
    {
        ksort($data);
        $str = '';
        foreach ($data as $k => $v) {

            $str .= '&' . $k . '=' . $v;
        }
        $str = trim($str, '&');
        $sign = strtoupper(md5($str . '&key=' . $appSecret));
        return $sign;
    }

}

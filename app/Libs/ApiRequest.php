<?php


namespace App\Libs;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class Util
 * 请求类
 * @package App\Libs
 */
class ApiRequest
{
    public $requestName;
    public $readTimeout = 60;
    public $connectTimeout = 20;
    public $version = "2.0";
    public $format = 'json';
    public $requestUrl;

    /**
     * @param string $requestUrl
     */
    public function setRequestUrl(string $requestUrl): void
    {
        $this->requestUrl = $requestUrl;
    }

    public $needSign = false;

    /**
     * @param bool $needSign
     */
    public function setNeedSign(bool $needSign): void
    {
        $this->needSign = $needSign;
    }

    public function __construct()
    {

    }

    /**
     * @param mixed $requestName
     */
    public function setRequestName($requestName): void
    {
        $this->requestName = $requestName;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function sendRequest($paramArr = [])
    {
        //追加参数数组
        $paramArr['v']         = $this->version;
        $paramArr['timestamp'] = date('Y-m-d H:i:s');
        $paramArr['format']    = $this->format;
        Log::info($this->requestName . '请求参数', $paramArr);
        //组织参数
        $strParam = http_build_query($paramArr);
        if ($this->needSign) {
            //生成签名
            $sign     = Util::createSign($paramArr);
            $strParam .= 'sign=' . $sign;
        }

        $this->requestUrl .= $strParam;
        $response         = $this->curl($this->requestUrl);
        return $response;
    }

    public function curl($url, $json = true, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, "top-sdk-php");
        //https 请求
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields)) {
            $postBodyString = "";
            $postMultipart  = false;
            foreach ($postFields as $k => $v) {
                if ("@" != substr($v, 0, 1))//判断是不是文件上传
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&";
                } else//文件上传用multipart/form-data，否则用www-form-urlencoded
                {
                    $postMultipart = true;
                    if (class_exists('\CURLFile')) {
                        $postFields[$k] = new \CURLFile(substr($v, 1));
                    }
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart) {
                if (class_exists('\CURLFile')) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                } else {
                    if (defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                    }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
            }
        }
        $reponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch), 0);
        } else {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new Exception($reponse, $httpStatusCode);
            }
        }
        curl_close($ch);
        if ($json)
            return json_decode($reponse, true);
        return $reponse;
    }

}

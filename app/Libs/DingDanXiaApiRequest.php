<?php


namespace App\Libs;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class Util
 * 请求类
 * @package App\Libs
 */
class DingDanXiaApiRequest
{
    protected $app_key;
    protected $secret;
    protected $readTimeout = 10;
    protected $connectTimeout = 10;
    protected $version = "2.0";
    protected $format = 'json';
    protected $requestUrl = 'http://gw.api.taobao.com/router/rest?';//沙箱环境http://gw.api.tbsandbox.com/router/rest

    /**
     * @param string $requestUrl
     */
    public function setRequestUrl(string $requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    public function __construct($app_key = "", $secret = "")
    {
        $this->app_key = $app_key;
        $this->secret = $secret;
    }


    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function sendRequest($paramArr = [])
    {
        //追加参数数组
        $paramArr['apikey'] = $this->app_key;
        $paramArr['secret'] = $this->secret;
        $paramArr['v'] = $this->version;
        $paramArr['timestamp'] = date('Y-m-d H:i:s');
        $paramArr['format'] = $this->format;

        //组织参数
        $strParam = http_build_query($paramArr);
        $this->requestUrl .= $strParam;
//        Log::info('请求完整链接', ['url' => $this->requestUrl]);
        $response = $this->curl($this->requestUrl);
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
            $postMultipart = false;
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

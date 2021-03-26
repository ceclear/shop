<?php


namespace App\Services;

use App\Libs\ApiRequest;
use App\Traits\Errors;
use Illuminate\Support\Facades\Cache;

class ToolService extends BaseService
{
    use Errors;

    protected $apiRequest;

    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    public function searchMobile()
    {
        $mobile = request('mobile');
        if (empty($mobile)) {
            $this->setError('', '手机号不能为空');
            return false;
        }
        $this->apiRequest->requestName = '查询手机号归属地';
        $this->apiRequest->requestUrl  = "http://www.zhaotool.com/v1/api/lt/e10adc3949ba59abbe56e057f20f883e/" . $mobile . "?";
        return $this->apiRequest->sendRequest();

    }

    public function postage()
    {
        $number = request('number');
        if (empty($number)) {
            $this->setError('', '快递单号不能为空');
            return false;
        }
        $cacheKey = 'postage_' . $number;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $this->apiRequest->setRequestName('查询快递' . $number);
        $this->apiRequest->setRequestUrl("http://www.kdcx.cn/index.php?");
        $companyList = $this->apiRequest->sendRequest(['r' => 'site/info', 'number' => $number]);
        if (empty($companyList)) {
            $this->setError('', '没有找到相关信息');
            return false;
        }
        $keys = array_keys($companyList);
        array_multisort($keys, $companyList);
        $companyCode = $companyList[0]['exname'];
        $this->apiRequest->setRequestUrl("http://api.kuaidi.com/openapi.html?");
        $list        = $this->apiRequest->sendRequest(['id' => config('constants.postage_api_key'), 'com' => $companyCode, 'nu' => $number, 'show' => 0, 'order' => 'desc']);
        $companyName = $companyList[0]['name'];
        Cache::set($cacheKey, ['list' => $list, 'companyName' => $companyName], 3600);
        return compact("list", "companyName");
    }
}

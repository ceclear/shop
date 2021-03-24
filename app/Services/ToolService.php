<?php


namespace App\Services;

use App\Libs\ApiRequest;
use App\Traits\Errors;

class ToolService extends BaseService
{
    use Errors;

    public function searchMobile()
    {
        $mobile = request('mobile');
        if (empty($mobile)) {
            $this->setError('', '手机号不能为空');
            return false;
        }
        $api              = new ApiRequest();
        $api->requestName = '查询手机号归属地';
        $api->requestUrl  = "http://www.zhaotool.com/v1/api/lt/e10adc3949ba59abbe56e057f20f883e/" . $mobile . "?";
        return $api->sendRequest();

    }
}

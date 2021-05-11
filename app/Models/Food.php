<?php

namespace App\Models;


use App\Libs\ApiRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Food extends Orm
{

    protected $guarded = ['id'];

    protected $table = 'food';

    protected $casts = [
        'material' => 'json',
        'process'  => 'json',
        'content'  => 'json'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function getWxFoodList($name, $num = 20)
    {
        $apiName                = '京东万象菜谱大全';
        $appId                  = config('constants.jd_wx_appkey');
        $apiRequest             = new ApiRequest();
        $apiRequest->requestUrl = 'https://way.jd.com/jisuapi/search?';
        $apiRequest->setRequestName($apiName);
        $rel = $apiRequest->sendRequest(['appkey' => $appId, 'keyword' => $name, 'num' => $num]);
        if (!$rel || $rel['code'] != 10000 || $rel['result']['status'] != 0) {
            Log::info('没有搜索到数据===' . $apiName . '===参数为：' . $name);
            return [];
        }
        $list = $rel['result']['result']['list'];
        Cache::set('jd_wx_food', array_column($list, 'name'));
        foreach ($list as $item) {
            $info = self::where('id', $item['id'])->where('classid', $item['classid'])->first();
            if (!$info) {
                $info = new self();
            }
            $info->classid     = $item['classid'];
            $info->id          = $item['id'];
            $info->name        = $item['name'];
            $info->peoplenum   = $item['peoplenum'];
            $info->preparetime = $item['preparetime'];
            $info->cookingtime = $item['cookingtime'];
            $info->content     = $item['content'];
            $info->pic         = $item['pic'];
            $info->tag         = $item['tag'];
            $info->material    = $item['material'];
            $info->process     = $item['process'];
            $info->save();
        }
        return $list;
    }
}

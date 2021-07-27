<?php

namespace App\Models;


use App\Libs\ApiRequest;
use Illuminate\Support\Facades\Cache;

class TaoGirl extends Orm
{
    const Sort = [
        'realName'    => '名字排序',
        'totalFanNum' => '粉丝量排序',
        'height'      => '身高排序',
        'weight'      => '体重排序',
        'type'        => '类型排序',
        'city'        => '城市排序'
    ];

    protected $guarded = ['id'];

    protected $casts = [
        'imgList' => 'json'
    ];

    public static function getCategory()
    {
        return [
            "欧美",
            "韩版",
            "日系",
            "英伦",
            "OL风",
            "学院",
            "淑女",
            "性感",
            "复古",
            "街头",
            "休闲",
            "民族",
            "甜美",
            "运动",
            "可爱",
            "大码",
            "中老年",
            "其他"
        ];
        $appId     = config('constants.show_api_appid');
        $appSecret = config('constants.show_api_secret');
        $apiRequest = new ApiRequest();
        $key        = "tao_nv_category";
        if (Cache::has($key)) {
            $category = Cache::get('tao_nv_category');
        } else {
            $apiRequest->requestUrl = 'https://route.showapi.com/126-1?';
            $apiRequest->setRequestName('易源淘女郎分类api');
            $rel = $apiRequest->sendRequest(['showapi_appid' => $appId, 'showapi_sign' => $appSecret]);
            if ($rel['showapi_res_code'] != 0) {
                return [];
            }
            $category = $rel['showapi_res_body']['allTypeList'];
            Cache::set($key, $category);
        }
        return $category;
    }

}

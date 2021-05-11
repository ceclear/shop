<?php

namespace App\Console\Commands;


use App\Libs\ApiRequest;
use App\Models\Food;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SyncFood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-food';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取菜谱';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $appId   = config('constants.jd_wx_appkey');
        $nameArr = Cache::get('jd_wx_food');
        if (empty($nameArr)) {
            return;
        }
        $apiName = '京东万象菜谱大全自动抓取';
        try {
            $apiRequest = new ApiRequest();
            foreach ($nameArr as $value) {
                $apiRequest->requestUrl = 'https://way.jd.com/jisuapi/search?';
                $apiRequest->setRequestName($apiName);
                $rel = $apiRequest->sendRequest(['appkey' => $appId, 'keyword' => $value, 'num' => 20]);
                if (!$rel || $rel['code'] != 10000 || $rel['result']['status'] != 0) {
                    Log::info('没有搜索到数据===' . $apiName . '===参数为：' . $value);
                    continue;
                }
                $list = $rel['result']['result']['list'];
                foreach ($list as $item) {
                    $info = Food::where('id', $item['id'])->where('classid', $item['classid'])->first();
                    if (!$info) {
                        $info = new Food();
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
            }
            Cache::forget('jd_wx_food');

        } catch (\Exception $exception) {
            $this->error("京东万象菜谱大全自动抓取出错" . $exception->getMessage());
            Log::error("京东万象菜谱大全自动抓取出错" . $exception->getMessage());
            return;
        }
    }

}

<?php

namespace App\Console\Commands;


use App\Libs\ApiRequest;
use App\Models\TaoGirl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SyncTao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:tao';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取淘女郎';

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
        $appId     = config('constants.show_api_appid');
        $appSecret = config('constants.show_api_secret');
        try {
            $apiRequest = new ApiRequest();
            $key        = "tao_nv_category";
            if (Cache::has($key)) {
                $category = Cache::get('tao_nv_category');
            } else {
                $apiRequest->requestUrl = 'https://route.showapi.com/126-1?';
                $apiRequest->setRequestName('易源淘女郎分类api');
                $rel = $apiRequest->sendRequest(['showapi_appid' => $appId, 'showapi_sign' => $appSecret]);
                if ($rel['showapi_res_code'] != 0) {
                    Log::error('易源淘女郎分类抓取出错====返回信息===' . $rel['showapi_res_error']);
                    return;
                }
                $category = $rel['showapi_res_body']['allTypeList'];
                Cache::set($key, $category);
            }
            return ;
            $apiRequest->setRequestName('易源淘女郎api');

            foreach ($category as $value) {
                $page = 0;
                $flag = true;
                do {
                    $page++;
                    if ($page % 100 == 0) {
                        sleep(60);
                    }
                    $arr = [];
                    $apiRequest->setRequestUrl("https://route.showapi.com/126-2?");
                    $res = $apiRequest->sendRequest(['type' => $value, 'page' => $page, 'showapi_appid' => $appId, 'showapi_sign' => $appSecret]);
                    if ($res['showapi_res_code'] == 0 && !empty($res['showapi_res_body']['pagebean']['contentlist'])) {
                        foreach ($res['showapi_res_body']['pagebean']['contentlist'] as $item) {
                            $data['avatarUrl'] = $item['avatarUrl'];
                            if (!empty($item['cardUrl']) && strpos("http", $item['cardUrl']) == false) {
                                $item['cardUrl'] = "http:" . $item['cardUrl'];
                            }
                            $data['cardUrl'] = $item['cardUrl'];
                            $data['city']    = $item['city'];
                            $data['height']  = $item['height'];
                            $data['weight']  = $item['weight'];
                            if (!empty($item['imgList'])) {
                                $data['imgList'] = json_encode($item['imgList']);
                            } else {
                                $data['imgList'] = '[]';
                            }
                            $data['realName']      = $item['realName'];
                            $data['totalFanNum']   = $item['totalFanNum'];
                            $data['totalFavorNum'] = $item['totalFavorNum'];
                            $data['userId']        = $item['userId'];
                            $data['link']          = $item['link'];
                            $data['type']          = $item['type'];
                            $data['created_at']    = time();
                            $data['updated_at']    = time();
                            $arr[]                 = $data;
                        }
                        TaoGirl::insert($arr);
                        $this->info("易源淘女郎抓取完成===分类===" . $value . "===分页==" . $page . '分类总计数量' . $res['showapi_res_body']['pagebean']['allNum']);
                        Log::info("易源淘女郎抓取完成===分类===" . $value . "===分页==" . $page . '分类总计数量' . $res['showapi_res_body']['pagebean']['allNum']);
                    } else {
                        $this->info("易源淘女郎抓取出错===分类===" . $value . "===分页==" . $page . '======返回信息======' . $res['showapi_res_error']);
                        Log::info("易源淘女郎抓取出错===分类===" . $value . "===分页==" . $page . '======返回信息======' . $res['showapi_res_error']);
                        $flag = false;
                    }
                    unset($arr);

                } while ($flag);

            }

        } catch (\Exception $exception) {
            $this->error("易源淘女郎抓取出错" . $exception->getMessage());
            Log::error("易源淘女郎抓取出错" . $exception->getMessage());
            return;
        }
    }

}

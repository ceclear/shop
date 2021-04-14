<?php

namespace App\Console\Commands;


use App\Libs\ApiRequest;
use App\Models\Bing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncBingPic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:bing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取bing图片';

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
            $start      = time();
            $apiRequest = new ApiRequest();

            $apiRequest->requestUrl = 'https://route.showapi.com/1287-1?';
            $apiRequest->setRequestName('易源api');
            $rel = $apiRequest->sendRequest(['showapi_appid' => $appId, 'showapi_sign' => $appSecret]);
            if ($rel['showapi_res_code'] != 0) {
                Log::error('易源bing图片抓取出错====返回信息===' . $rel['showapi_res_error']);
                return;
            }
            $bing            = new Bing();
            $bing->pic_url   = $rel['showapi_res_body']['data']['img_1920'];
            $bing->copyright = $rel['showapi_res_body']['data']['copyright'];
            $bing->save();
            $end = time();
            $this->info("bing图片抓取完成===耗时==" . ($end - $start));
            Log::info("bing图片抓取完成===耗时==" . ($end - $start));
        } catch (\Exception $exception) {
            $this->error("bing图片抓取出错" . $exception->getMessage());
            Log::error("bing图片抓取出错" . $exception->getMessage());
            return;
        }
    }

}

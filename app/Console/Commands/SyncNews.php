<?php

namespace App\Console\Commands;


use App\Libs\JuHeRequest;
use App\Models\News;
use App\Models\RequestLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取新闻';

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
        $appKey = config('constants.ju_he_news_key');
        try {
            $start      = time();
            $apiRequest = new JuHeRequest();
            $type       = array_rand(News::TYPE_ARR);
            $apiRequest->setAppKey($appKey);
            for ($i = 1; $i <= 2; $i++) {
                $apiRequest->setRequestUrl('http://v.juhe.cn/toutiao/index?');
                $apiRequest->setRequestName('聚合新闻');
                $result = $apiRequest->sendRequest(['type' => $type, 'page' => $i, 'page_size' => 5]);
                if (!$result) {
                    Log::error('新闻抓取请求失败了');
                    continue;
                }
                if ($result['error_code'] != 0) {
                    Log::error('新闻抓取返回错误====' . $result['error_code'] . '===' . $result['reason']);
                    continue;
                }
                $array = $result['result']['data'];

                foreach ($array as $item) {
                    if ($item['is_content'] != 1) {
                        continue;
                    }
                    $info = News::where('uniquekey', $item['uniquekey'])->first();
                    if (!$info) {
                        $info = new News();
                    }
                    $info->uniquekey   = $item['uniquekey'];
                    $info->title       = $item['title'];
                    $info->image       = $item['thumbnail_pic_s'];
                    $info->category    = $item['category'];
                    $info->author_name = empty($item['author_name']) ? 'ceclear' : $item['author_name'];
                    $info->url         = $item['url'];
                    $info->pub_date    = strtotime($item['date']);
                    $arr               = [];
                    if (!empty($item['thumbnail_pic_s'])) {
                        $arr[] = $item['thumbnail_pic_s'];
                    }
                    if (!empty($item['thumbnail_pic_s02'])) {
                        $arr[] = $item['thumbnail_pic_s02'];
                    }
                    if (!empty($item['thumbnail_pic_s03'])) {
                        $arr[] = $item['thumbnail_pic_s03'];
                    }
                    $info->pics       = $arr;
                    $info->created_at = time();
                    $info->updated_at = time();
                    $info->content    = self::syncDetail($item['uniquekey'], $apiRequest);
                    $info->save();
                    RequestLog::create(['name' => '聚合新闻'.$apiRequest->requestUrl, 'param' => ['type' => $type, 'page' => $i, 'page_size' => 5], 'request_date' => date('Y-m-d H:i:s')]);
                }
                $this->info('当前分页=======' . $i . '=======完成');
            }

            $end = time();
            $this->info("同步完成===耗时==" . ($end - $start));
        } catch (\Exception $exception) {
            $this->error("同步出错" . $exception->getMessage());
            return;
        }
    }

    public static function syncDetail($uniqueKey, $apiRequest)
    {
        $apiRequest->setRequestUrl('http://v.juhe.cn/toutiao/content?');
        $result = $apiRequest->sendRequest(['uniquekey' => $uniqueKey]);
        RequestLog::create(['name' => '聚合新闻'.$apiRequest->requestUrl, 'param' => ['uniquekey' => $uniqueKey], 'request_date' => date('Y-m-d H:i:s')]);
        return $result['result']['content'];
    }
}

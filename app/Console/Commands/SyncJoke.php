<?php

namespace App\Console\Commands;


use App\Libs\JuHeRequest;
use App\Models\Joke;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SyncJoke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:joke';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取笑话';

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
        $appKey = config('constants.ju_he_joke_key');
        try {
            $start      = time();
            $apiRequest = new JuHeRequest();
            $apiRequest->setRequestName('聚合笑话 ');
            $apiRequest->setAppKey($appKey);
            for ($i = 1; $i <= 100; $i++) {
                $apiRequest->setRequestUrl('http://v.juhe.cn/joke/content/list.php?');
                $result = $apiRequest->sendRequest(['sort' => 'desc', 'page' => $i, 'pagesize' => 20, 'time' => time()]);
                if (!$result) {
                    Log::error('笑话抓取请求失败');
                    continue;
                }
                if ($result['error_code'] != 0) {
                    Log::error('笑话抓取返回错误====' . $result['error_code'] . '===' . $result['reason']);
                    continue;
                }
                $array = $result['result']['data'];

                foreach ($array as $item) {

                    $info = Joke::where('hash_id', $item['hashId'])->first();
                    if (!$info) {
                        $info = new Joke();
                    }
                    $info->hash_id     = $item['hashId'];
                    $info->content     = $item['content'];
                    $info->update_time = $item['unixtime'];
                    $info->created_at  = time();
                    $info->updated_at  = time();
                    $info->save();
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

}

<?php

namespace App\Console\Commands;


use App\Libs\ApiRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncJk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-jk {t?} {s?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取驾考题';

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
        $type    = $this->argument('t') ?? 'C1';
        $subject = $this->argument('s') ?? 1;
        $size    = 100;
        try {
            $apiRequest = new ApiRequest();
            $page       = 0;
            $flag       = true;
            $total      = 0;
            do {
                $page++;
                if ($page % 50 == 0) {
                    sleep(60);
                }
                $apiRequest->requestUrl = 'https://way.jd.com/jisuapi/driverexamQuery?';
                $apiRequest->setRequestName('京东万象驾考题抓取');
                $rel = $apiRequest->sendRequest(['appkey' => $appId, 'type' => $type, 'subject' => $subject, 'pagesize' => $size, 'pagenum' => $page, 'sort' => 'normal']);
                if (!$rel || $rel['code'] != 10000) {
                    $this->error('抓取京东万象驾考题出错,返回消息' . $rel['msg']);
                    Log::error('抓取京东万象驾考题出错,返回消息' . $rel['msg'], $rel);
                    $flag = false;
                }
                if ($total >= $rel['result']['result']['total']) {
                    $this->info('抓取京东万象驾考题完成');
                    Log::info('抓取京东万象驾考题完成');
                    $flag = false;
                }
                $arr = [];
                if ($flag) {
                    $list = $rel['result']['result']['list'];
                    foreach ($list as $item) {
                        $data['question'] = $item['question'];
                        $data['type']     = $type;
                        $data['subject']  = $subject;
                        $data['question'] = $item['question'];
                        $optionArr        = [];
                        for ($i = 1; $i < 10; $i++) {
                            $key = 'option' . $i;
                            if (!empty($item[$key])) {
                                $optionArr[] = $item[$key];
                            }
                        }
                        $data['options']       = json_encode($optionArr);
                        $data['answer']        = $item['answer'];
                        $data['explain']       = $item['explain'];
                        $data['pic']           = $item['pic'] ?? '';
                        $data['question_type'] = $item['type'];
                        $data['created_at']    = date('Y-m-d H:i:s');
                        $data['updated_at']    = date('Y-m-d H:i:s');
                        $arr[]                 = $data;
                        $total++;
                    }
                    DB::table('driver')->insert($arr);
                    $this->info('分页======' . $page . '=======完成==已获得数据===' . $total);
                }
            } while ($flag);

        } catch (\Exception $exception) {
            $this->error("抓取京东万象驾考题出错" . $exception->getMessage());
            Log::error("抓取京东万象驾考题出错" . $exception->getMessage());
            return;
        }
    }

}

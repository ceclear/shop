<?php

namespace App\Console\Commands;


use App\Libs\JuHeRequest;
use App\Models\TodayHistory;
use App\Models\TodayHistoryDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncTodayHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:today:history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取历史今天';

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
        $appKey = config('constants.ju_he_today_history_key');
        try {
            $start      = time();
            $apiRequest = new JuHeRequest();

            $apiRequest->setRequestName('聚合历史今天');
            $apiRequest->setAppKey($appKey);
            $dateArr = [];
            $now     = date('Y/1/1');
            $list    = TodayHistory::all(['day'])->toArray();
            $exist   = array_column($list, 'day');
            for ($i = 0; $i < 365; $i++) {
                $day = date('n/j', strtotime("+$i day", strtotime($now)));
                if (in_array($day, $exist) || in_array($day, $dateArr)) {
                    continue;
                }
                $dateArr[] = $day;
            }
            foreach ($dateArr as $value) {
                $apiRequest->setRequestUrl('http://v.juhe.cn/todayOnhistory/queryEvent.php?');
                $result = $apiRequest->sendRequest(['date' => $value]);
                if (!$result) {
                    Log::error('历史今天取请求失败');
                    continue;
                }
                if ($result['error_code'] != 0) {
                    Log::error('历史今天抓取返回错误====' . $result['error_code'] . '===' . $result['reason']);
                    continue;
                }
                $array = $result['result'];
                $info  = TodayHistory::where('day', $value)->first();
                if (!$info) {
                    $info = new TodayHistory();
                }
                $info->day        = $value;
                $info->content    = $array;
                $info->created_at = time();
                $info->updated_at = time();
                foreach ($array as $item) {
                    $detailArr = self::syncDetail($item['e_id'], $apiRequest);
                    if (!$detailArr) {
                        continue;
                    }
                    if ($detailArr['error_code'] != 0 || $detailArr['reason'] != 'success') {
                        continue;
                    }
                    foreach ($detailArr['result'] as $vv) {
                        $model = TodayHistoryDetail::where('e_id', $vv['e_id'])->first();
                        if (!$model) {
                            $model = new TodayHistoryDetail();
                        }
                        $model->e_id    = $vv['e_id'];
                        $model->title   = $vv['title'];
                        $model->content = $vv['content'];
                        $model->pic_url = $vv['picUrl'];
                        $model->save();
                    }
                    $info->save();

                }
                Log::info($value . '历史今天抓取成功');
            }

            $end = time();
            $this->info("同步完成===耗时==" . ($end - $start));

        } catch (\Exception $exception) {
            $this->error("同步出错" . $exception->getMessage());
            Log::error( "历史今天抓取失败" . $exception->getMessage());
            return;
        }
    }

    public static function syncDetail($eId, $apiRequest)
    {
        $apiRequest->setRequestUrl('http://v.juhe.cn/todayOnhistory/queryDetail.php?');
        return $apiRequest->sendRequest(['e_id' => $eId]);
    }

}

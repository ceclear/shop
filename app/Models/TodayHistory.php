<?php

namespace App\Models;


use App\Libs\JuHeRequest;
use Illuminate\Support\Facades\Log;

class TodayHistory extends Orm
{

    protected $guarded = ['id'];

    protected $casts = [
        'content' => 'json'
    ];

    public static function syncToday($dateArr)
    {
        $appKey = config('constants.ju_he_today_history_key');
        try {
            $apiRequest = new JuHeRequest();
            $apiRequest->setRequestName('聚合历史今天');
            $apiRequest->setAppKey($appKey);
            foreach ($dateArr as $value) {
                $apiRequest->setRequestUrl('http://v.juhe.cn/todayOnhistory/queryEvent.php?');
                $result = $apiRequest->sendRequest(['date' => $value]);
                if (!$result) {
                    Log::error('历史今天取请求失败');
                    continue;
                }
                if ($result['error_code'] != 0) {
                    Log::error('历史今天抓取返回错误====' . $result['error_code'] . '===' . $result['reason']);
                    break;
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
            return true;

        } catch (\Exception $exception) {
            Log::error("历史今天抓取失败" . $exception->getMessage());
            return false;
        }
    }

    public static function syncDetail($eId, $apiRequest)
    {
        $apiRequest->setRequestUrl('http://v.juhe.cn/todayOnhistory/queryDetail.php?');
        return $apiRequest->sendRequest(['e_id' => $eId]);
    }
}

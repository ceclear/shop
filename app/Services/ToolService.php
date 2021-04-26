<?php


namespace App\Services;

use App\Libs\ApiRequest;
use App\Libs\JuHeRequest;
use App\Models\Similar;
use App\Models\TodayHistory;
use App\Models\TodayHistoryDetail;
use App\Traits\Errors;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ToolService extends BaseService
{
    use Errors;

    protected $apiRequest;

    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    public function searchMobile()
    {
        $mobile = request('mobile');
        if (empty($mobile)) {
            $this->setError('', '手机号不能为空');
            return false;
        }
        $this->apiRequest->requestName = '查询手机号归属地';
        $this->apiRequest->requestUrl  = "http://www.zhaotool.com/v1/api/lt/e10adc3949ba59abbe56e057f20f883e/" . $mobile . "?";
        return $this->apiRequest->sendRequest();

    }

    public function postage()
    {
        $number = request('number');
        if (empty($number)) {
            $this->setError('', '快递单号不能为空');
            return false;
        }
        $cacheKey = 'postage_' . $number;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $this->apiRequest->setRequestName('查询快递' . $number);
        $this->apiRequest->setRequestUrl("http://www.kdcx.cn/index.php?");
        $companyList = $this->apiRequest->sendRequest(['r' => 'site/info', 'number' => $number]);
        if (empty($companyList)) {
            $this->setError('', '没有找到相关信息');
            return false;
        }
        $keys = array_keys($companyList);
        array_multisort($keys, $companyList);
        $companyCode = $companyList[0]['exname'];
        $this->apiRequest->setRequestUrl("http://api.kuaidi.com/openapi.html?");
        $list        = $this->apiRequest->sendRequest(['id' => config('constants.postage_api_key'), 'com' => $companyCode, 'nu' => $number, 'show' => 0, 'order' => 'desc']);
        $companyName = $companyList[0]['name'];
        Cache::set($cacheKey, ['list' => $list, 'companyName' => $companyName], 3600);
        return compact("list", "companyName");
    }

    public function Similar()
    {
        $words = request('words') ?? '';
        if (empty($words)) {
            $this->setError('', '请输入词语');
            return false;
        }
        $info = Similar::where('words', $words)->first();
        if (!$info) {
            if (Cache::has('similar')) {
                $arr = json_decode(Cache::get('similar'), true);
                if (in_array($words, $arr)) {
                    $this->setError('', '这个词语我没查到(＾－＾)V');
                    return false;
                }
            }
            $apiRequest = new JuHeRequest();
            $apiRequest->setAppKey(config('constants.ju_he_similar_key'));
            $apiRequest->setRequestName('查询近义词' . $words);
            $apiRequest->setRequestUrl("http://apis.juhe.cn/tyfy/query?");
            $similarResult = $apiRequest->sendRequest(['type' => 1, 'word' => $words]);
            $apiRequest->setRequestUrl("http://apis.juhe.cn/tyfy/query?");
            $antonymResult = $apiRequest->sendRequest(['type' => 2, 'word' => $words]);
            if (!$similarResult || !$antonymResult) {
                $this->setError('', '未查询到数据');
                return false;
            }
            if ($similarResult['error_code'] != 0 || $antonymResult['error_code'] != 0) {
                Log::info('近义反义词查询出错' . $similarResult['reason'] . '=======' . $antonymResult['reason']);
                $this->setError('', '未查询到数据');
                return false;
            }
            $similarList = $similarResult['result']['words'];
            $antonymList = $antonymResult['result']['words'];
            if (empty($similarList) || empty($antonymList)) {
                $this->setError('', '这个词语我没查到(＾－＾)V');
                if (Cache::has('similar')) {
                    $arr = json_decode(Cache::get('similar'), true);
                    if (!in_array($words, $arr)) {
                        $arr[] = $words;
                        Cache::set('similar', json_encode($arr));
                    }
                } else {
                    Cache::set('similar', json_encode([$words]));
                }
                return false;
            }
            $info = Similar::create(['words' => $words, 'similar' => $similarList, 'antonym' => $antonymList]);
        }
        return $info;
    }

    public function today()
    {
        $date = request('date') ?? date('n/j');
        $info = TodayHistory::where('day', $date)->first();
        if (!$info) {
            $this->setError('', '暂无记录');
            return false;
        }
        return $info;
    }

    public function todayDetail()
    {
        $etId = request('id');
        $info = TodayHistoryDetail::where('e_id', $etId)->first();
        if (!$info) {
            $this->setError('', '暂无记录');
            return false;
        }
        return $info;
    }
}

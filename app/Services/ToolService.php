<?php


namespace App\Services;

use App\Libs\ApiRequest;
use App\Libs\DataRedis;
use App\Libs\JuHeRequest;
use App\Models\Driver;
use App\Models\DriverWrong;
use App\Models\Food;
use App\Models\Similar;
use App\Models\TodayHistory;
use App\Models\TodayHistoryDetail;
use App\Traits\Errors;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
            $rel = TodayHistory::syncToday([$date]);
            if ($rel) {
                $info = TodayHistory::where('day', $date)->first();
                return $info;
            }
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

    public function foodList()
    {
        $keyword       = request('word');
        $more          = request('more') ?? false;//直接加载第三方
        $page          = request('page') ?? 1;
        $model         = new Food();
        $where['name'] = ['symbol' => 'like', 'val' => '%' . $keyword . '%'];
        $list          = $model->getListPage($where, [], $page, 20)->toArray();
        if (!empty($keyword) && ($more || empty($list))) {
            $model->getWxFoodList($keyword);
            $list = $model->getListPage($where, [], $page, 20)->toArray();
        }
        if (!empty($list)) {
            $list = array_merge($list);
        }
        return $list;
    }

    public function foodDetail()
    {
        $id = request('id') ?? 0;
        return Food::where('id', $id)->first();
    }

    public function driverDetail()
    {
        $userId  = request()->uid;
        $id      = request('id') ?? 0;
        $order   = request('next') == 1 ? 'asc' : 'desc';
        $isFirst = request('is_first');
//        $info    = Driver::where('id', '>', $id)->orderBy('id', $order)->first();
        $info  = Driver::orderBy(DB::raw('RAND()'))->first();
        $count = Driver::count();
        if ($isFirst == 2) {
            $current = DataRedis::getRedisInstance()->incr('jia_kao_' . $userId);
        } else {
            DataRedis::getRedisInstance()->set('jia_kao_' . $userId, 1);
            $current = 1;
        }
        if ($info) {
//            $option    =$info['options'];
//            $answerArr = json_decode($option);
            $answerArr = $info['options'];
            if (!empty($answerArr)) {
                $kk = 0;
                foreach ($answerArr as $key => $item) {
                    if ($info['answer'] == substr($item, 0, 1)) {
                        $kk = $key;
                        break;
                    }
                }
                $info['answer_key'] = $kk;
            } else {
                $info['answer_key'] = $info['answer'] == '对' ? 0 : 1;
            }
        }
        return compact("info", "count", "current");
    }

    public function addWrongDriver()
    {
        $userId = request()->uid;
        $id     = request('id') ?? 0;
        if (empty($id)) {
            $this->setError('', '请传入错误题');
            return false;
        }
        $info = DriverWrong::where('driver_id', $id)->where('user_id', $userId)->first();
        if ($info) {
            $this->setError('', '已经加入错题集了');
            return false;
        }
        DriverWrong::create(['user_id' => $userId, 'driver_id' => $id]);
        return true;
    }

    public function driverCount()
    {
        return Driver::selectRaw('count(*) as total,type')->groupBy('type')->get();
    }

    public function cctCalculate()
    {
        $cct = request('cct') ?? 0;
        $ex  = request('ex') ?? 0;
        if (empty($cct)) {
            $this->setError('', '请填写cct数量');
            return false;
        }
        if (!is_numeric($cct)) {
            $this->setError('', 'cct数量格式错误');
            return false;
        }
        if (!empty($ex) && !is_numeric($ex)) {
            $this->setError('', '经验格式错误');
            return false;
        }
        return $this->cctFormat($cct, $ex);
    }

    protected function cctFormat($baseCCT, $ex = 0, &$arr = [], $num = 1, $canTotal = 0, $needTotal = 0, $old = 0)
    {
        if ($baseCCT <= 0) {
//            if ($canTotal > 0 && $needTotal > 0) {
//                $trueLast = $canTotal - $needTotal;
//                $lost     = $old - $canTotal;
//                $this->info('======最终能提出' . $trueLast . '=====被割韭菜==' . $lost . '===');
//            } else {
//                $this->info('==============================');
//            }
            $trueLast           = $canTotal - $needTotal;
            $lost               = $old - $canTotal;
            $return['list']     = $arr;
            $return['trueLast'] = sprintf("%.2f", $trueLast);
            $return['lost']     = sprintf("%.2f", $lost);;
            return $return;
        }
//        $can  = (int)$baseCCT * 0.95;
        $can = sprintf("%.2f", $baseCCT * 0.95);
//        $need = (int)($can * 6 - $ex) / 10 * 1.05;
        $need = sprintf("%.2f", (int)($can * 6 - $ex) / 10 * 1.05);
//        $this->info("==想提出==" . $baseCCT . '==能提出==' . $can . '==需要充值==' . $need . '==第' . $num . '次操作==');
        $data['old']  = $baseCCT;
        $data['can']  = $can;
        $data['need'] = $need;
        $arr[]        = $data;
        $num++;
        $canTotal  += $can;
        $needTotal += $need;
        $old       += $baseCCT;
        return $this->cctFormat($need, $ex, $arr, $num, $canTotal, $needTotal, $old);

    }
}

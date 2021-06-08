<?php

namespace App\Console\Commands;


use App\Models\MeiDian;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncPraise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:praise';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取美点';

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
        $info = $this->checkVoteTime();
        if ($info['voteTimeSecond'] == 0) {
            $this->praiseVideo();
        }


    }

    public function checkVoteTime()
    {
        $url      = 'https://api.mdweilai.cn/japi/v2/activity-service/topic/topic/pls?page=1&pageSize=10';
        $header[] = 'sign:b956b42a12b7b10a0511990423f77822';
        $header[] = 'uid:6598';
        $header[] = 'timestamp:1623137234239';
        $header[] = 'random:57757562';

//        $data = '{}';
//        $data = json_decode($data, true);
        $rel  = $this->curl_get($url, $header);
        $rel  = json_decode($rel, true);
        $info = $rel['data']['list'][0];
        Log::info('vote_info投票倒计时', ['info'=>$info['voteTimeSecond']]);
        $this->info('投票倒计时' . $info['voteTimeSecond']);
        return $info;
    }

    public function praiseVideo()
    {
        $url      = 'https://api.mdweilai.cn/api/v1/topic/thumbsup';
        $header[] = 'sign:c708fa9d2ea0137368466d59624fd0f3';
        $header[] = 'uid:6598';
        $header[] = 'timestamp:1623139357949';
        $header[] = 'random:1447415302';

//        $sign = self::makeSign(['uid' => 6598, 'timestamp' => 1623138382381, 'random' => 1444735196]);
//        dd($sign);
        $userIds = MeiDian::where('user_id', '!=', 0)->limit(1)->orderBy(DB::raw('RAND()'))->get(['user_id'])->toArray();
        foreach ($userIds as $item) {
            $data = '{"videoId": 44924,	"timeSpace": 3600,"topicId": 10}';
            $data = json_decode($data, true);
            $rel  = $this->http_post($url, $header, $data);
            $rel  = json_decode($rel, true);
            $this->info($rel['message']);
            Log::info('点赞结果' . $rel['message']);
        }
    }


    public function http_post($sUrl, $aHeader, $aData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($aData));
        $sResult = curl_exec($ch);
        if ($sError = curl_error($ch)) {
            die($sError);
        }
        curl_close($ch);
        return $sResult;
    }

    public static function makeSign($data)
    {
        ksort($data);
        $str = '';
        foreach ($data as $k => $v) {

            $str .= '&' . $k . '=' . $v;
        }
        $str  = trim($str, '&');
        $sign = strtoupper(md5($str));
        return $sign;
    }

    function curl_get($url, $header)
    {


        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 超时设置,以秒为单位
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //执行命令
        $data = curl_exec($curl);

        // 显示错误信息
        if (curl_error($curl)) {
            print "Error: " . curl_error($curl);
        } else {
            curl_close($curl);
            return $data;
        }
    }

}


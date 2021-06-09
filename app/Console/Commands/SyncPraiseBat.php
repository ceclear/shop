<?php

namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncPraiseBat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:praise:bat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '批量给指定用户投票';

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
        $this->checkVoteTime();
    }

    public function checkVoteTime()
    {
        $url = 'https://api.mdweilai.cn/japi/v2/activity-service/topic/topic/pls?page=1&pageSize=10';
        $arr = DB::table('user_info')->where('status',1)->get();
        foreach ($arr as $item) {
            $header[] = 'uid:' . $item->uid;
            //        $data = '{}';
//        $data = json_decode($data, true);
            $rel  = $this->curl_get($url, $header);
            $rel  = json_decode($rel, true);
            $info = $rel['data']['list'][0];
            Log::info('用户：' . $item->uid . 'vote_info投票倒计时', ['info' => $info['voteTimeSecond']]);
            $this->info('用户：' . $item->uid.'==投票倒计时' . $info['voteTimeSecond']);
            unset($header);
            if ($info['voteTimeSecond'] == 0 || (time()-strtotime($item->update_at))>600) {
                $this->praiseVideo($item->sign, $item->timestamp, $item->uid, $item->random);
                DB::table('user_info')->where('uid',$item->uid)->update(['update_at'=>Carbon::now()->toDateTimeString()]);
                sleep(25);
            }

        }


    }

    public function praiseVideo($sign, $timestamp, $uid, $random)
    {
        $url      = 'https://api.mdweilai.cn/api/v1/topic/thumbsup';
        $header[] = 'sign:' . $sign;
        $header[] = 'uid:' . $uid;
        $header[] = 'timestamp:' . $timestamp;
        $header[] = 'random:' . $random;

        $data = '{"videoId": 45339,	"timeSpace": 3600,"topicId": 10}';
        $data = json_decode($data, true);
        $rel  = $this->http_post($url, $header, $data);
        $rel  = json_decode($rel, true);
        $this->info($rel['message']);
        Log::info('点赞结果' . $rel['message']);

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


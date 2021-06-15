<?php

namespace App\Console\Commands;


use App\Models\MeiDian;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncMd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:md';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '点赞或者抓取视频';

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
//        $this->getVideoList();
        $this->checkRank();
    }

    public function praiseVideo($info)
    {
        $url      = 'https://api.mdweilai.cn/api/v1/videoReply/likeVideo';
        $header[] = 'sign:' . $info->like_video_sign;
        $header[] = 'uid:' . $info->uid;
        $header[] = 'timestamp:' . $info->like_timestamp;
        $header[] = 'random:' . $info->like_random;

        $arr = DB::table('meidian')->orderBy(DB::raw('RAND()'))->limit(1)->get()->toArray();
        foreach ($arr as $item) {
            $data = '{"merchantVideoId":' . $item->video_id . '}';
            $data = json_decode($data, true);
            $rel  = $this->http_post($url, $header, $data);
            $rel  = json_decode($rel, true);
            $this->info('用户'.$info->uid.'===点赞视频' . $item->video_id . '=====点赞=======' . $rel['message']);
            Log::info('用户'.$info->uid.'===点赞视频' . $item->video_id . '=====点赞=======' . $rel['message']);
        }
    }

    public function checkRank()
    {
        $url = 'https://api.mdweilai.cn/api/v1/video/ranking';
        $arr = DB::table('praise_info')->get()->toArray();
        foreach ($arr as $item) {
            $header[] = 'sign:' . $item->rank_sign;
            $header[] = 'uid:' . $item->uid;
            $header[] = 'timestamp:' . $item->timestamp;
            $header[] = 'random:' . $item->random;
            $data     = '{"countType": 1,"pageIndex": 1,"pageSize": 10}';
            $data     = json_decode($data, true);
            $rel      = $this->http_post($url, $header, $data);
            $rel      = json_decode($rel, true);
            $rank     = $rel['data']['me']['ranking'];
            unset($header);
            $this->info('用户===' . $item->uid . '=====当前排名' . $rank);
            if ($item->uid ==6887 &&$rank <= 15) {
                Log::info('用户===' . $item->uid . '=====当前排名' . $rank . '====无需点赞视频');
                continue;
            }
            if ($item->uid ==6598 &&$rank <= 16) {
                Log::info('用户===' . $item->uid . '=====当前排名' . $rank . '====无需点赞视频');
                continue;
            }
            $this->praiseVideo($item);
        }
    }

    public function getVideoList()
    {
        $url      = 'https://api.mdweilai.cn/api/v1/index';
        $header[] = 'sign:b18da8cf98eed0a0e672815557e461ac';
        $header[] = 'uid:6598';
        $header[] = 'timestamp:1623116050074';
        $header[] = 'random:848974448';

//        $stand = 1;
        for ($i = 1; $i < 100000; $i++) {

            $stand = -1;
            $times = 0;
            for ($j = 1; $j < 500; $j++) {
                $num  = 0;
                $data = '{"pageIndex":' . $j . ',"pageSize":100,"standard":' . $stand . '}';
                $data = json_decode($data, true);
                $rel  = $this->http_post($url, $header, $data);
                $rel  = json_decode($rel, true);

                $array = $rel['data']['data'];
                if ($times >= 5) {
                    $this->error('当前执行=====' . $i . '=====分页' . $j . '====失败超过5次');
                    break;
                }
                if (empty($array)) {
                    $this->error('当前执行=====' . $i . '=====分页' . $j . '====失败次数' . $times . '====原因==' . $rel['message']);
                    $times++;
                    continue;
                }
                $this->info('当前执行======' . $i . '=====分页' . $j . '===成功====' . $num . '===条==');
                foreach ($array as $item) {
                    $info = MeiDian::where('video_id', $item['id'])->first();
                    if ($info) {
                        continue;
                    }
                    $info              = new MeiDian();
                    $info->video_id    = $item['id'];
                    $info->user_id     = $item['user']['id'];
                    $info->cover_url   = $item['coverUrl'];
                    $info->video       = $item['videoId'];
                    $info->playurl     = $item['playurl'];
                    $info->description = $item['description'];
                    $info->phone       = $item['user']['phone'];
                    $info->nickname    = $item['user']['nickname'];
                    $info->userToken   = $item['user']['userToken'];
                    $info->created_at  = Carbon::now()->toDateTimeString();
                    $info->save();
                    $num++;

                }
                sleep(5);
            }


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


}


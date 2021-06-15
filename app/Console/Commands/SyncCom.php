<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncCom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:com';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '评论排行';

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

    public function commentVideo($info)
    {
        $url      = 'https://api.mdweilai.cn/api/v1/videoReply/addReply';
        $header[] = 'sign:' . $info->com_sign;
        $header[] = 'uid:' . $info->uid;
        $header[] = 'timestamp:' . $info->com_timestamp;
        $header[] = 'random:' . $info->com_random;

        $arr     = DB::table('meidian')->orderBy(DB::raw('RAND()'))->limit(1)->get()->toArray();
        $comment = DB::table('jokies')->selectRaw("LENGTH(content) as a,content")->having("a", '<', 150)->orderBy(DB::raw('RAND()'))->first();
        foreach ($arr as $item) {
            $data = '{"replyType": 1,"merchantVideoId": ' . $item->video_id . ',"toUserId": "","content": "' . $comment->content . '","headurl": "http://oss.mdweilai.com/images/6887/headurl.jpeg?time\u003d1623207929\u0026x-oss-process\u003dimage/resize,l_200,limit_1/format,jpg"}';
            $data = json_decode($data, true);
            $rel  = $this->http_post($url, $header, $data);
            $rel  = json_decode($rel, true);
            $this->info('用户'.$info->uid.'====评论视频' . $item->video_id . '====评论=====' . $rel['message']);
            Log::info('用户'.$info->uid.'====评论视频' . $item->video_id . '====评论=====' . $rel['message']);
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
            $data     = '{"countType": 2,"pageIndex": 1,"pageSize": 10}';
            $data     = json_decode($data, true);
            $rel      = $this->http_post($url, $header, $data);
            $rel      = json_decode($rel, true);
            $rank     = $rel['data']['me']['ranking'];
            unset($header);
            $this->info('用户===' . $item->uid . '=====当前排名' . $rank);
            Log::info('用户===' . $item->uid . '=====当前排名' . $rank);
            if ($item->uid == 6887&&$rank <= 15) {
                Log::info('用户===' . $item->uid . '=====当前排名' . $rank . '====无需评价视频');
                continue;
            }
            if ($item->uid == 6598&&$rank <= 16) {
                Log::info('用户===' . $item->uid . '=====当前排名' . $rank . '====无需评价视频');
                continue;
            }
            $this->commentVideo($item);
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


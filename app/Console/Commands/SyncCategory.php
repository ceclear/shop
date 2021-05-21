<?php

namespace App\Console\Commands;


use App\Libs\DingDanXiaApiRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-cat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步分类';

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
        $this->test(8574, 200);
        die;
        try {
            $start      = time();
            $apiRequest = new DingDanXiaApiRequest(env('DDX_API_KEY'));

            $this->getRequestData($apiRequest, 0, 0);
            $end = time();
            $this->info("同步完成===耗时==" . ($end - $start));
        } catch (\Exception $exception) {
            $this->error("同步出错" . $exception->getMessage());
            return;
        }
    }

    public function getRequestData($apiRequest, $parentId = 0, $grade = 0, $selfParentId = 0)
    {
        $apiRequest->setRequestUrl('http://api.tbk.dingdanxia.com/jd/goods_category?');
        $array = $apiRequest->sendRequest(['parentId' => $parentId, 'grade' => $grade]);
        if (empty($array['data'])) {
            $this->info('没有获取到数据===JD分类ID==' . $parentId . '===grade==' . $grade . '===返回消息' . $array['msg']);
            return;
        }
        $count = 10;
        $arr   = [];
        foreach ($array['data'] as $item) {
            $data['parent_id']  = $selfParentId == 0 ? $item['parentId'] : $selfParentId;
            $data['name']       = $item['name'];
            $data['level']      = $grade + 1;
            $data['created_at'] = time();
            $data['updated_at'] = time();
            if (count($arr) <= $count) {
                $arr[] = $data;
                $ppId  = DB::table('categories')->insertGetId($data);
//                sleep(1);
                $this->info('分类==' . $item['name'] . '===grade==' . $grade . '==完成');
                if ($item['grade'] < 2) {
                    $this->getRequestData($apiRequest, $item['id'], $item['grade'] + 1, $ppId);
                }
            }
        }
    }

    public function test($baseCCT, $ex = 0, $num = 1, $canTotal = 0, $needTotal = 0, $old = 0)
    {
//        $baseCCT = 8574;//需要提出的cct数量
//        原始需要提出
//        能提出
//        需要充值
        if ($baseCCT <= 0) {
            if ($canTotal > 0 && $needTotal > 0) {
                $trueLast = $canTotal - $needTotal;
                $lost     = $old - $canTotal;
                $this->info('======最终能提出' . $trueLast . '=====被割韭菜==' . $lost . '===');
            } else {
                $this->info('==============================');
            }
            return;
        }
        $can  = (int)$baseCCT * 0.95;
        $need = (int)($can * 6 - $ex) / 10 * 1.05;
        $this->info("==想提出==" . $baseCCT . '==能提出==' . $can . '==需要充值==' . $need . '==第' . $num . '次操作==');
        $num++;
        $canTotal  += $can;
        $needTotal += $need;
        $old       += $baseCCT;
        $this->test($need, $ex, $num, $canTotal, $needTotal, $old);
    }
}

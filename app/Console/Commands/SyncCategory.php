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
}

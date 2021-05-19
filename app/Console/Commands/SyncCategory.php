<?php

namespace App\Console\Commands;


use App\Libs\DingDanXiaApiRequest;
use EasyWeChat\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $app->subscribe_message->send([
            'touser'      => 'oc53p5dwSYOIKYOgduU-7aIOZoAU',
            'template_id' => 'sNrOvfxKncoCjKZ-KM77XV6y8vrTUgWK98wwOV2L4S4',
            'data'        => [
                'thing1' => 'test',
                'thing2' => '1.12',
                'thing3' => '作业提交',
                'thing4' => '完成'
            ]
        ]);
        $app->template_message->send()
        dd(222);
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

    public function getRequestData($apiRequest, $parentId = 0, $grade = 0)
    {
        $apiRequest->setRequestUrl('http://api.tbk.dingdanxia.com/jd/goods_category?');
        $array = $apiRequest->sendRequest(['parentId' => $parentId, 'grade' => $grade]);
        if (empty($array['data'])) {
            $this->info('没有获取到数据===JD分类ID==' . $parentId . '===grade==' . $grade . '===返回消息' . $array['msg']);
            Log::info('没有获取到数据===JD分类ID==' . $parentId . '===grade==' . $grade . '===返回消息' . $array['msg']);
            return;
        }
        $count = 15;
        $arr   = [];
        foreach ($array['data'] as $item) {
            $data['id']         = $item['id'];
            $data['parent_id']  = $item['parentId'];
            $data['name']       = $item['name'];
            $data['level']      = $grade + 1;
            $data['created_at'] = time();
            $data['updated_at'] = time();
            $arr[]              = $data;
            if (count($arr) == $count) {
                $this->info('grade==' . $grade . '==完成');
                Log::info('grade==' . $grade . '==完成');
                break;
            }
            if ($item['grade'] < 2) {
                $this->getRequestData($apiRequest, $item['id'], $item['grade'] + 1);
            }

        }

        DB::table('categories')->insert($arr);
    }
}

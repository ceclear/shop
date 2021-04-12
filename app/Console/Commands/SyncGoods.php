<?php

namespace App\Console\Commands;


use App\Libs\DingDanXiaApiRequest;
use App\Models\Goods;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncGoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-jd {num?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取商品';

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
            $apiRequest = new DingDanXiaApiRequest(config('constants.ding_dan_xia_api_key'));

            $num = 50;
            if ($this->argument('num')) {
                $num = $this->argument('num');
            }
//            $category = Category::all()->toArray();
            $total  = 0;
            $update = 0;
            for ($i = 1; $i <= $num; $i++) {
                $pageIndex = $i;
                $apiRequest->setRequestUrl('http://api.tbk.dingdanxia.com/jd/material_query?');
                $array = $apiRequest->sendRequest(['eliteId' => 4, 'pageIndex' => $pageIndex]);
                if (empty($array['data'])) {
                    $this->info('没有获取到数据===返回消息==' . $array['msg']);
                    Log::info('抓取订单侠京东商品出错,没有获取到数据===返回消息==' . $array['msg'] . '当前分页' . $i);
                    return;
                }
                foreach ($array['data'] as $item) {
                    $info = Goods::where('sku', $item['skuId'])->first();
                    if (!$info) {
                        $info = new Goods();
                        $total++;
                    } else {
                        $update++;
                    }
                    $info->sku   = $item['skuId'];
                    $info->title = $item['skuName'];
//                    foreach ($category as $value) {
//                        if ($value['name'] == $item['categoryInfo']['cid1Name'] || $value['name'] == $item['categoryInfo']['cid2Name'] || $value['name'] == $item['categoryInfo']['cid3Name']) {
//                            $info->category_id = $value['id'] ?? 1;
//                            break;
//                        }
//                    }
                    $info->cid1           = $item['categoryInfo']['cid1'];
                    $info->cid1_name      = $item['categoryInfo']['cid1Name'];
                    $info->cid2           = $item['categoryInfo']['cid2'];
                    $info->cid2_name      = $item['categoryInfo']['cid2Name'];
                    $info->cid3           = $item['categoryInfo']['cid3'];
                    $info->cid3_name      = $item['categoryInfo']['cid3Name'];
                    $info->brand_code     = $item['brandName'] ?? '';
                    $info->images         = array_column($item['imageInfo']['imageList'], 'url');
                    $info->discover       = $item['imageInfo']['imageList'][0]['url'];
                    $info->price          = $item['priceInfo']['price'] * 100;
                    $info->discount_price = $item['priceInfo']['lowestPrice'] * 100;
                    $info->stock          = rand(1, 1000);
                    $info->description    = array_column($item['imageInfo']['imageList'], 'url');
                    $info->sale           = $item['inOrderCount30Days'];
                    $info->enable_at      = time();
                    $info->created_at     = time();
                    $info->updated_at     = time();
                    $info->save();
                }
            }
            $end = time();
            $this->info("同步完成===耗时==" . ($end - $start) . '新增' . $total . '条数据,更新' . $update . '条数据');
            Log::info('订单侠京东商品同步完成===新增' . $total . '条数据,更新' . $update . '条数据');
        } catch (\Exception $exception) {
            $this->error("同步出错" . $exception->getMessage());
            Log::error("订单侠京东商品同步出错" . $exception->getMessage());
            return;
        }
    }
}

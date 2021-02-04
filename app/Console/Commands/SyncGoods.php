<?php

namespace App\Console\Commands;


use App\Libs\DingDanXiaApiRequest;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
            $apiRequest = new DingDanXiaApiRequest(env('DDX_API_KEY'));
            $apiRequest->setRequestUrl('http://api.tbk.dingdanxia.com/jd/material_query?');
            $num = 1;
            if ($this->argument('num')) {
                $num = $this->argument('num');
            }
            $category = Category::all()->toArray();
            for ($i = 1; $i <= $num; $i++) {
                $pageIndex = $i;
                $array     = $apiRequest->sendRequest(['eliteId' => 4, 'pageIndex' => $pageIndex]);
                if (empty($array['data'])) {
                    $this->info('没有获取到数据===返回消息==' . $array['msg']);
                    return;
                }
                $arr = [];
                foreach ($array['data'] as $item) {
                    $data['sku']   = $item['skuId'];
                    $data['title'] = $item['skuName'];
                    foreach ($category as $value) {
                        if ($value['name'] == $item['categoryInfo']['cid1Name'] || $value['name'] == $item['categoryInfo']['cid2Name'] || $value['name'] == $item['categoryInfo']['cid3Name']) {
                            $data['category_id'] = $value['id'];
                            break;
                        }
                    }
                    $data['brand_code']     = $item['brandName'];
                    $data['images']         = array_column($item['imageInfo']['imageList'], 'url');
                    $data['discover']       = $item['imageInfo']['imageList'][0]['url'];
                    $data['price']          = $item['priceInfo']['price'] * 100;
                    $data['discount_price'] = $item['priceInfo']['lowestPrice'] * 100;
                    $data['stock']          = rand(1, 1000);
                    $data['description']    = array_column($item['imageInfo']['imageList'], 'url');
                    $data['sale']           = $item['inOrderCount30Days'];
                    $data['enable_at']      = time();
                    $data['created_at']     = time();
                    $data['updated_at']     = time();
                    Goods::create($data);
//                    $arr[]                  = $data;
                }
//                DB::table('goods')->insert($arr);
            }
            $end = time();
            $this->info("同步完成===耗时==" . ($end - $start));
        } catch (\Exception $exception) {
            $this->error("同步出错" . $exception->getMessage());
            return;
        }
    }
}

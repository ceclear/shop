<?php

namespace App\Http\Controllers;


use App\Jobs\RegisterMember;
use App\Mail\Register;
use App\Models\Advert;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{

    public function index()
    {
        $field            = ['id', 'sku', 'discover', 'title', 'brand_code', 'discount', 'images', 'is_new', 'price', 'discount_price', 'star'];
        $newList          = Cache::remember('new_list', 3600, function () use ($field) {
            return Goods::where('status', 1)->where('is_new', 1)->limit(6)->orderBy(DB::raw('RAND()'))->get($field)->toArray();
        });
        $bestList         = Cache::remember('best_list', 3600, function () use ($field) {
            return Goods::where('status', 1)->limit(6)->orderBy('sale', 'desc')->get($field)->toArray();
        });
        $recList          = Cache::remember('rec_list', 3600, function () use ($field) {
            return Goods::where('status', 1)->where('is_recommend', 1)->limit(6)->orderBy(DB::raw('RAND()'))->get($field)->toArray();
        });
        $saleOff          = Cache::remember('sale_off', 3600, function () use ($field) {
            return Goods::where('discount', '>', 0)->where('status', 1)->orderBy('id', 'desc')->limit(2)->get($field)->toArray();
        });
        $banner           = Cache::remember('banner_list', 3600, function () use ($field) {
            return Advert::with(["ad_position" => function ($query) {
                $query->where('symbol', 'sybanner');
            }])->where('status', 1)->get()->toArray();
        });
        $categoryGoodList = Cache::remember('category_goods_list', 3600, function () use ($field) {
            $category = Category::where('parent_id', 0)->get(['id', 'name'])->toArray();
            $arr      = [];
            foreach ($category as $item) {
                $result = Goods::where('cid1', $item['id'])->orwhere('cid2', $item['id'])->orwhere('cid3', $item['id'])->limit(5)->get($field)->toArray();
                if ($result && count($arr) < 6) {
                    $data['goods'] = $result;
                    $data['name']  = $item['name'];
                    $data['id']    = $item['id'];
                    $arr[]         = $data;
                }
            }
            return $arr;
        });

        return view('index', compact("newList", "bestList", "recList", "saleOff", "banner", "categoryGoodList"));
    }

    public function about()
    {
        return view('about');
    }

    public function test()
    {
        Mail::to('594652523@qq.com')->send(new Register());
//        for ($i=1;$i<=100;$i++){
//            MemberRedis::getRedisInstance()->lpush('list1',$i);
//        }
//        MemberRedis::getRedisInstance()->blpop('list1',4);
        RegisterMember::dispatch(1221)->onQueue('aa')->delay(now()->addSeconds(1));
        echo 'success';
    }

    public function ceclear()
    {
        phpinfo();
    }
}

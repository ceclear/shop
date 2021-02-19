<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\Goods;
use App\Services\MemberService;
use App\Traits\ResponseJson;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    use ResponseJson;

    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {

        $field    = ['id', 'sku', 'discover', 'title', 'brand_code', 'discount', 'images', 'is_new', 'price', 'discount_price', 'star'];
        $newList  = Goods::where('status', 1)->where('is_new', 1)->limit(6)->orderBy(DB::raw('RAND()'))->get($field)->toArray();
        $bestList = Goods::where('status', 1)->limit(6)->orderBy('sale', 'desc')->get($field)->toArray();
        $recList  = Goods::where('status', 1)->where('is_recommend', 1)->limit(6)->orderBy(DB::raw('RAND()'))->get($field)->toArray();
        $saleOff  = Goods::where('discount', '>', 0)->where('status', 1)->orderBy('id', 'desc')->limit(2)->get($field)->toArray();
        $banner   = Advert::with(["ad_position" => function ($query) {
            $query->where('symbol', 'sybanner');
        }])->where('status', 1)->get()->toArray();
        return $this->responseJson(0, '', compact("newList", "bestList", "recList", "saleOff", "banner"));
    }
}

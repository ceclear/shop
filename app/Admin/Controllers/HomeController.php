<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Joke;
use App\Models\Members;
use App\Models\News;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $data = self::statics();
        return $content
//            ->title('Dashboard')
//            ->description('Description...')
//            ->row(Dashboard::title())
            ->title('首页')
            ->body(view('admin.home.index', $data));
//            ->row(function (Row $row) {
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::environment());
//                });
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::extensions());
//                });
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::dependencies());
//                });
//            });
    }

    public static function statics()
    {
        $member = Members::count();
        $goods  = Goods::count();
        $news   = News::count();
        $joke   = Joke::count();
        return compact("member", "goods", "news", "joke");
    }

    public function chartData()
    {
        $month       = strtotime(date('Y-m'));
        $goods       = DB::table('goods')->where('created_at', '>=', $month)->selectRaw("count(*) as total,FROM_UNIXTIME(created_at,?) as days", ['%c-%e'])->groupBy("days")->get()->toArray();
        $news        = DB::table('news')->where('created_at', '>=', $month)->selectRaw("count(*) as total,FROM_UNIXTIME(created_at,?) as days", ['%c-%e'])->groupBy("days")->get()->toArray();
        $goodsData   = [];
        $newsData    = [];
        $dataDateArr = [];
        $m           = date('n');
        for ($i = 1; $i <= date("t"); $i++) {
            $dataDateArr[] = $m . '-' . $i;
        }
        $goodKeys = [];
        if (!empty($goods)) {
            foreach ($goods as $item) {
                $newGoods[$item->days] = $item->total;
            }
            $goodKeys = array_keys($newGoods);
        }
        $newKeys = [];
        if (!empty($news)) {
            foreach ($news as $item) {
                $newNews[$item->days] = $item->total;
            }
            $newKeys = array_keys($newNews);
        }
        foreach ($dataDateArr as $item) {
            $goodsTotal = 0;
            if (in_array($item, $goodKeys)) {
                $goodsTotal = $newGoods[$item];
            }
            $goodsData[] = $goodsTotal;
            $newsTotal   = 0;
            if (in_array($item, $newKeys)) {
                $newsTotal = $newNews[$item];
            }
            $newsData[] = $newsTotal;
        }
        return response()->json(compact("goodsData", "newsData", "dataDateArr"));
    }
}

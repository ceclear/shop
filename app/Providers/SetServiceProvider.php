<?php

namespace App\Providers;

use App\Libs\CartRedis;
use App\Models\Category;
use App\Models\Rate;
use App\Models\TaoGirl;
use Illuminate\Support\ServiceProvider;

class SetServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('layouts.header', function ($view) {
            $categoryList = Category::getCategory(3);
            $rateList     = Rate::rows();
            $categoryShow = request()->getPathInfo() == "/";
            $userInfo     = session('user_info');
            $cart         = CartRedis::getRedisInstance()->lists($userInfo['id'] ?? 0);
            $taoCategory  = TaoGirl::getCategory();
            $view->with(compact("categoryList", "rateList", "categoryShow", "cart", "taoCategory"));
        });
    }
}

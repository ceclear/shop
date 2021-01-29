<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Rate;
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
            $categoryList = Category::getCategory();
            $rateList = Rate::all()->toArray();
            $categoryShow = request()->getPathInfo() == "/";
            $view->with(compact("categoryList", "rateList", "categoryShow"));
        });
    }
}

<?php

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'IndexController@index')->name('index');

Route::get('mail', 'MailController@index');
Route::get('test123', 'IndexController@test');
Route::get('about.html', 'IndexController@about');
Route::get('category', 'CategoryController@lists');
Route::get('ceclear', 'IndexController@ceclear');

Route::group(['prefix' => 'member'], function (Router $router) {
    $router->get('login.html', 'MemberController@login')->name('member.login');
    $router->get('register.html', 'MemberController@register')->name('member.register');
    $router->post('login_submit', 'MemberController@loginSubmit')->name('member.web_login');
    $router->get('logout.html', 'MemberController@logout')->name('member.logout');
});

Route::group(['prefix' => 'level1'], function () {
    Route::get('/', 'SchoolController@index')->name('level1');
    Route::get('show/{sub_id?}', 'SchoolController@show');
    Route::post('submit', 'SchoolController@submit');
    Route::get('success', 'SchoolController@success');
    Route::post('check_user', 'SchoolController@checkUser');
});

Route::group(['prefix' => 'article'], function () {
    Route::get('list.html', 'ArticleController@lists')->name('article.list');
    Route::get('detail.html', 'ArticleController@detail')->name('article.detail');
});
Route::group(['prefix' => 'news'], function () {
    Route::get('list.html', 'NewsController@lists')->name('news.list');
    Route::get('detail.html', 'NewsController@detail')->name('news.detail');
    Route::get('joke.html', 'NewsController@joke')->name('news.joke');
});

Route::group(['prefix' => 'study'], function () {
    Route::get('index.html', 'StudyController@index')->name('study');
    Route::get('level_list', 'StudyController@level')->name('study.level');
    Route::post('detail', 'StudyController@detail')->name('study.detail');
});

Route::get('contact.html', 'NewsController@contact')->name('contact');

Route::group(['prefix' => 'product'], function () {
    Route::get('detail.html', 'GoodsController@detail')->name('goods.detail');
    Route::get('shop.html', 'GoodsController@shop')->name('goods.shop');
    Route::get('wishlist.html', 'GoodsController@wishList')->name('goods.wish');
    Route::post('wish_add.html', 'GoodsController@wishAdd')->name('goods.wish_add');//添加希望清单
    Route::post('card_add.html', 'GoodsController@addCart')->name('goods.cart_add');//添加购物车
    Route::get('cart.html', 'GoodsController@cart')->name('goods.cart');//添加购物车
    Route::post('cart_delete.html', 'GoodsController@cartDelete')->name('goods.cart_delete');
    Route::get('tao-girl.html', 'GoodsController@taoGirl')->name('goods.tao_girl');
    Route::get('tao-girl-detail.html', 'GoodsController@taoDetail')->name('goods.tao_girl_detail');
    Route::get('tao-girl-detail-data.html', 'GoodsController@taoDetailAjax')->name('goods.tao_girl_detail_ajax');
    Route::get('tao-iframe.html', 'GoodsController@iframe')->name('goods.iframe');//详情
});


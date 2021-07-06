<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(["namespace" => "Api", 'prefix' => 'user'], function ($router) {
    $router->post('login', 'LoginController@login')->name('api.login');//网页ajax登录
    $router->post('register', 'LoginController@register')->name('api.register');//网页ajax注册

});

Route::group(["namespace" => "Api"], function ($router) {
    $router->get('index', 'IndexController@index');//首页
    $router->get('category', 'CategoryController@lists');//分类列表
    $router->get('goods/lists', 'GoodsController@lists');//商品列表
    $router->get('study/math', 'StudyController@createMath');//数学生成
    $router->post('study/create_subtract','StudyController@createSubtract')->middleware('jwt');
    $router->get('study/subtract_list','StudyController@lists')->middleware('jwt');
    $router->get('search_mobile','ToolController@searchMobile');
    $router->get('postage','ToolController@Postage')->middleware('jwt');;//快递查询
    $router->get('similar','ToolController@Similar');//近义反义词
    $router->get('today','ToolController@TodayList');//历史今天
    $router->get('today_detail','ToolController@TodayDetail');//历史今天详情
    $router->get('food_list','ToolController@foodList')->middleware('jwt');//菜谱列表
    $router->get('food_detail','ToolController@foodDetail')->middleware('jwt');//菜谱列表
    $router->get('driver_detail','ToolController@driverDetail');
    $router->post('add_driver_wrong','ToolController@addWrongDriver')->middleware('jwt');
    $router->get('driver_count','ToolController@driverCount');
    $router->post('cct_to_do','ToolController@cctCalculate');
});

Route::group(["namespace" => "Api", 'prefix' => 'user'], function ($router) {
    $router->post('mini_login', 'LoginController@miniLogin')->name('api.mini_login');//小程序登录
    $router->get('info', 'MemberController@info')->middleware('jwt');//会员信息
    $router->get('address_list', 'AddressController@lists')->middleware('jwt');//地址列表
    $router->post('add_address', 'AddressController@add')->middleware('jwt');//添加地址
    $router->post('edit_address', 'AddressController@edit')->middleware('jwt');//编辑地址
    $router->get('address_info', 'AddressController@info')->middleware('jwt');//地址详情
    $router->post('address_delete', 'AddressController@delete')->middleware('jwt');//删除地址
    $router->post('address_default', 'AddressController@setDefault')->middleware('jwt');//设置默认地址
});

Route::group(["namespace" => "Api", 'prefix' => 'cart', 'middleware' => 'jwt'], function ($router) {
    $router->get('index', 'MemberController@cartList');//购物车列表
    $router->post('add', 'MemberController@cartAdd');//添加购物车
    $router->post('inc', 'MemberController@cart_inc');//增加减少数量
    $router->post('delete', 'MemberController@cartDel');//删除购物车商品
});

Route::group(["namespace" => "Api", 'prefix' => 'order', 'middleware' => 'jwt'], function ($router) {
    $router->get('checkout', 'OrderController@orderCheckout');//购物车结算
});

Route::group(["namespace" => "Api", 'prefix' => 'goods'], function ($router) {
    $router->get('detail', 'GoodsController@detail');//详情
});

Route::group(["namespace" => "Api", 'prefix' => 'wechat'], function ($router) {
    $router->get('home', 'WechatController@index');//订阅消息入口
});

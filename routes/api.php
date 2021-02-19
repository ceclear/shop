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
    $router->post('login', 'LoginController@login')->name('api.login');
    $router->post('register', 'LoginController@register')->name('api.register');

});

Route::group(["namespace" => "Api"], function ($router) {
    $router->get('index', 'IndexController@index');
    $router->get('category', 'CategoryController@lists');
    $router->get('goods/lists', 'GoodsController@lists');

});

Route::group(["namespace" => "Api", 'prefix' => 'user'], function ($router) {
    $router->post('mini_login', 'LoginController@miniLogin')->name('api.mini_login');
    $router->get('info', 'MemberController@info')->middleware('jwt');
    $router->get('address_list', 'AddressController@lists')->middleware('jwt');
    $router->post('add_address', 'AddressController@add')->middleware('jwt');
    $router->post('edit_address', 'AddressController@edit')->middleware('jwt');
    $router->get('address_info', 'AddressController@info')->middleware('jwt');
    $router->post('address_delete', 'AddressController@delete')->middleware('jwt');
    $router->post('address_default', 'AddressController@setDefault')->middleware('jwt');
});


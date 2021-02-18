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
    $router->get('info', 'MemberController@info')->middleware('jwt');
});

Route::group(["namespace" => "Api", 'prefix' => 'user'], function ($router) {
    $router->post('mini_login', 'LoginController@miniLogin')->name('api.mini_login');
});


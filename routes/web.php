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


Route::get('/', 'IndexController@index');
Route::get('about.html', 'IndexController@about');
Route::get('category', 'CategoryController@lists');

Route::group(['prefix' => 'member'], function (Router $router) {
    $router->get('login.html', 'MemberController@login');
    $router->get('register.html', 'MemberController@register');
    $router->post('register_submit', 'MemberController@registerSubmit');
    $router->post('login_submit', 'MemberController@loginSubmit');
});

Route::group(['prefix' => 'level1'], function () {
    Route::get('/', 'SchoolController@index');
    Route::get('show/{sub_id?}', 'SchoolController@show');
    Route::post('submit', 'SchoolController@submit');
    Route::get('success', 'SchoolController@success');
});

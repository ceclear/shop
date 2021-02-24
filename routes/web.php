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
    $router->get('login.html', 'MemberController@login')->name('member.login');
    $router->get('register.html', 'MemberController@register')->name('member.register');
    $router->post('login_submit', 'MemberController@loginSubmit')->name('member.web_login');
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

Route::group(['prefix' => 'study'], function () {
    Route::get('index.html', 'StudyController@index')->name('study');
    Route::get('level_list', 'StudyController@level')->name('study.level');
    Route::post('detail', 'StudyController@detail')->name('study.detail');
});


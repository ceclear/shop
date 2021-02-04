<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as'         => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->post('editor2-upload-image', 'UploadController@editorUploadImage');//editor2上传图片
    $router->get('school-subtract-detail', 'SchoolController@subtractDetail');
    $router->resource('school', SchoolController::class);//作业
    $router->resource('article-cat', ArticleCatController::class);//文章分类
    $router->resource('article-list', ArticleController::class);//文章列表
    $router->resource('ad-position', AdPositionController::class);//广告位置
    $router->resource('advert', AdvertController::class);//广告
});

<?php

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

Route::get('/login', "LoginController@showLogin")->name('login');
Route::get('/login/out', "LoginController@loginOut")->name('loginOut');
Route::post('/login/doVerify', "LoginController@doVerify")->name('doVerify');
//测试
Route::get('/test', "TestController@test");

Route::group(['middleware' => \App\Http\Middleware\AdminMiddleware::class], function () {
    Route::get('/', "HomeController@showHome")->name('home');
    //文章
    Route::get('/content/list', "ContentController@showArticleList");
    Route::get('/content/add', "ContentController@showAddContent");
    Route::get('/content/edit', "ContentController@showUpDataContent");
    Route::get('/content/save', "ContentController@saveContent");
    Route::post('/content/update', "ContentController@upDateContent");
    Route::post('/content/del', "ContentController@delContent");
    Route::get('/content/preview', "ContentController@showPreview");
    //分类
    Route::get('/content/classify', "ContentController@showClassify");
    Route::post('/content/classify/modify', "ContentController@modifyContentClassify");
    Route::get('/content/classify/add', "ContentController@showAddContentClassify");
    Route::post('/content/classify/save', "ContentController@saveContentClassify");
    Route::get('/content/classify/edit', "ContentController@showEditContentClassify");
    Route::post('/content/classify/change', "ContentController@changeContentClassify");
    //商品分类
    Route::get('goods/classify', "GoodsController@showGoodsClassify");
    Route::post('/goods/classify/modify', "GoodsController@modifyGoodsClassify");
    Route::get('/goods/classify/add', "GoodsController@showAddGoodsClassify");
    Route::post('/goods/classify/save', "GoodsController@saveGoodsClassify");
    Route::get('/goods/classify/edit', "GoodsController@showEditGoodsClassify");
    Route::post('/goods/classify/change', "GoodsController@modifyGoodsClassify");
});

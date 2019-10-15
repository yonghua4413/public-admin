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
    Route::get('/content/classify/get', "ContentController@getClassify");
});


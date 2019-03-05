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

Route::get('/', function () {
    return view('welcome');
});
//商家账号资源路由
Route::resource('users','UsersController');

//商家账号资源路由
Route::resource('admins','AdminsController');

//商家信息资源路由
Route::resource('shops','ShopsController');

//商家分类资源路由
Route::resource('shopcategory','ShopCategoryController');

//平台活动资源路由
Route::resource('activity','ActivityController');

//平台会员管理路由
Route::resource('members','MembersController');

//定义登录路由
Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');

//上传图片
Route::post('/upload','ShopsController@upload');





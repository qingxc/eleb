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
//商家信息资源路由
Route::resource('shops','ShopsController');
//商家分类资源路由
Route::resource('shopcategory','ShopCategoryController');






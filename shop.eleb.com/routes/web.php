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

//商家菜品分类资源路由
Route::resource('menucategory','menucategoryController');

//商家菜品资源路由
Route::resource('menus','menusController');

////平台活动资源路由
//Route::resource('activity','ActivityController');

//文件上传路由
Route::post('/upload','MenusController@upload');

//活动
Route::get('/login.shows/{activity}','LoginController@shows')->name('login.shows');
Route::get('/login.show','LoginController@show')->name('login.show');

//定义登录路由
Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');
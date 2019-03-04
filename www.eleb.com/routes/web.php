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

//                                                      商家信息


//客户端商家列表接口(支持商家搜索
Route::get('/api/bzlist','ApiController@bzlist');
//客户端获取指定商家指定商家接口
Route::get('/api/business','ApiController@business');


//                                                       地址管理

// 地址列表接口
Route::get('/api/addressList','ApiController@addressList');

// 指定地址接口
Route::get('/api/address','ApiController@address');

// 保存新增地址接口
Route::post('/api/addAddress','ApiController@addAddress');

// 保存修改地址接口
Route::post('/api/editAddress','ApiController@editAddress');





// 保存购物车接口
Route::post('/api/addCart','ApiController@addCart');

//获取购物车列表接口
Route::get('/api/cart','ApiController@cart');

                                                        //订单

//获取订单列表接口
Route::get('/api/orderList','ApiController@orderList');

// 添加订单接口
Route::post('/api/addorder','ApiController@addorder');

//获取指定订单列表接口
Route::get('/api/order','ApiController@order');


//                                                       用户注册登录


//客户端注册
Route::post('/api/regist','ApiController@regist');

//客户端登录
Route::post('/api/loginCheck','ApiController@loginCheck');

//获取验证码
Route::get('/api/sms','ApiController@sms');

//密码修改
Route::post('/api/changePassword','ApiController@changePassword');

//忘记密码
Route::post('/api/forgetPassword','ApiController@forgetPassword');


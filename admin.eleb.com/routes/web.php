<?php

Route::get('/', function () {
    return view('welcome');
});

////商家分类模块
//Route::group(['middleware' => ['permission:查看商家分类列表']], function () {
//    Route::resource('shop','ShopCategoriesController');
//    Route::get('shop/{shop}/status/','ShopCategoriesController@status')->name('shop.status');//商家分类状态路由
//});



//商家账号资源路由
Route::resource('users','UsersController');

Route::group(['middleware' => ['permission:商家账号列表']],function(){
    Route::get('users','UsersController@index')->name('users');
});




//管理员资源路由
Route::resource('admins','AdminsController');
Route::group(['middleware' => ['permission:管理员列表']],function(){
    Route::get('admins.index','adminsController@index')->name('admins.index');
});


//管理员角色路由
Route::get('adminjs/{admin}','AdminsController@adminjs')->name('adminjs');
Route::post('/adminjsg/{admin}/','AdminsController@adminjsg')->name('adminjsg');

//商家信息资源路由
Route::resource('shops','ShopsController');
Route::group(['middleware' => ['permission:商家信息列表']],function(){
    Route::get('shops.index','shopsController@index')->name('shops.index');
});
//商家分类资源路由
Route::resource('shopcategory','ShopCategoryController');
Route::group(['middleware' => ['permission:分类列表']],function(){
    Route::get('shopcategory.index','shopcategoryController@index')->name('shopcategory.index');
});

//平台活动资源路由
Route::resource('activity','ActivityController');
Route::group(['middleware' => ['permission:活动列表']],function(){
    Route::get('activity.index','activityController@index')->name('activity.index');
});

//平台会员管理路由
Route::resource('members','MembersController');
Route::group(['middleware' => ['permission:会员列表']],function(){
    Route::get('members.index','membersController@index')->name('members.index');
});

//RBAC角色管理路由
Route::resource('rbacjs','RbacJsController');

//RBAC权限管理路由
Route::resource('permission','PermissionController');

//导航菜单管理路由
Route::resource('navs','NavsController');

//定义登录路由
Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');

//上传图片
Route::post('/upload','ShopsController@upload');

//抽奖路由定义
Route::resource('events','EventsController');

//抽奖报名路由定义
Route::resource('eventmembers','EventMembersController');
















//商家审核后电子邮件通知商家
Route::get('/mail',function($to){
    $title = '全新体验，手机也能玩转网易邮箱2.0';
    $content = '<p>	
你的店铺已经<span style="color: red">审核通过</span>！
请登录确认</p>';
    try{
        \Illuminate\Support\Facades\Mail::send('email.default',compact('title','content'),
            function($message){
                $to = 'xunzhaomeijia2@163.com';
                $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
            });
    }catch (Exception $e){
        return '邮件发送失败';
    }
});




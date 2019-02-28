<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\MenuCategory;
use App\Models\Menus;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;

class ApiController extends Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin:*');

    }


    //商家列表接口(支持商家搜索)
    public function bzlist(Request $request){
        //如果有参数keyword就模糊查询
        if($keyword = $request->keyword){
            $rows = Shops::where('shop_name','like',"%$keyword%")->where('status',1)->get();
        }else{
            $rows = Shops::where('status',1)->get();
        }

        return $rows;

    }

    //获得指定商家接口
    public function business(Request $request){


        $shop = Shops::find($request->id);//商家信息数据
        $shop['evaluate']=[
            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>1,
                "send_time"=>30,
                "evaluate_details"=>"不怎么好吃"
            ],
            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>4.5,
                "send_time"=>30,
                "evaluate_details"=>"很好吃"
            ],
            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>5,
                "send_time"=>30,
                "evaluate_details"=>"很好吃"
            ],
            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>4.7,
                "send_time"=>30,
                "evaluate_details"=>"很好吃"
            ],
            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>5,
                "send_time"=>30,
                "evaluate_details"=>"很好吃"
            ]
        ];//评论数据
        $shop['commodity'] = MenuCategory::where('shop_id',$request->id)->get();//获取商家菜品分类数据
        foreach($shop['commodity'] as $row){
            $row['goods_list'] = Menus::where('category_id',$row->id)->get();
        }

        return $shop;
    }


    //会员注册
    public function regist(Request $request){
        //验证用户名存不存在
        if(empty(Members::where('username',$request->username)->get())){
            return ['status' => 'false','message' => '该用户名已存在，请重新填写.'];
        }

        //验证手机号码
        if(empty(Members::where('tel',$request->tel)->get())){
            return ['status' => 'false','message' => '该手机号已被注册，请重新填写.'];
        }

        //判断手机验证码是否正确
        if($request->sms != Redis::get($request->tel)){
            return ['status' => 'false','message' => '验证码错误，请从新获取'];
        }




        Members::create([
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'tel'=>$request->tel
        ]);

        //清除redis
        Redis::del($request->tel);

        $data=[];
        $data['status'] = 'true';
        $data['message'] = '注册成功';
        return $data;
    }

    //会员登录
    public function loginCheck(Request $request){
//        dd($request);
        if(Auth::attempt([
            'username' => $request->name,
            'password' => $request->password,
        ])){
            return ['status' => 'true','message' => '登录成功','user_id' => Auth::user()->id,'username' => Auth::user()->username];

        }
        return ['status' => 'false','message' => '账号或用户名错误，登录失败！'];
}


    //短信验证
    public function sms(Request $request)
    {
//        return 1;
        // 短信应用SDK AppID
        $appid = 1400189795; // 1400开头

// 短信应用SDK AppKey
        $appkey = "f0f379ddda7c39e41088a3881b20cb35";

// 需要发送短信的手机号码
        $phoneNumber = $request->tel;

// 短信模板ID，需要在短信应用中申请
        $templateId = 285192;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "firstyun"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [mt_rand(1000,9999),5];//验证码,分钟
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp = json_decode($result);
            //var_dump($rsp->errmsg);exit;
            //判断短信是否发送成功
            if($rsp->errmsg == 'OK'){
                //将验证码写入redis [手机号  = 》  验证码],并设置过期时间5分钟
                Redis::setex($phoneNumber,300,$params[0]);
            }

            //获取验证码成功
            return ['status'=>'true','message' => '获取验证码成功'];
        } catch(\Exception $e) {
            echo var_dump($e);

            //获取验证码失败
            return ['status'=>'false','message' => '获取验证码失败'];
        }
    }
    
    
    
    
//    public function rds()
//    {
//        Cache::put('dd','123',0.2);
//        return Cache::get('dd');
//    }
}

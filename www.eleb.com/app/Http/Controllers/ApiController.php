<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Carts;
use App\Models\Members;
use App\Models\MenuCategory;
use App\Models\Menus;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
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

            foreach ($row['goods_list'] as $good){
                $good['goods_id'] = $good->id;
            }
        }

        return $shop;
    }


                                    //会员管理

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
//            dd(Auth::user());
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

    //修改密码
    public function changePassword(Request $request){
        if (Hash::check($request->oldPassword,Auth::user()->password)) {
            //验证通过，保存数据
            Auth::user()->password = Hash::make($request->newPassword);
            Auth::user()->save();
            return ['status'=>'true', 'message'=>'修改成功'];
        }else{
            return ['status'=>'false', 'message'=>'修改失败'];
        }

    }

    //忘记密码
    public function forgetPassword(Request $request){
        //判断手机验证码是否正确
        if($request->sms != Redis::get($request->tel)){
            return ['status' => 'false','message' => '验证码错误，请从新获取'];
        }
        Members::where('tel',$request->tel)->update(['password' => Hash::make($request->password)]);
        return ['status'=>'true', 'message'=>'重置成功'];
    }




    //                                              收货地址管理

    //收货地址列表
    public function addressList(Request $request){
//        dd(Auth::user());
        $rows = Address::where('user_id',Auth::user()->id)->get();
        return $rows;
    }


    //创建收货地址
    public function addAddress(Request $request){
//

        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'tel' => 'required|numeric|digits_between:11,11',//电话号码格式
                'provence' => 'required',
                'city' => 'required',
                'area' => 'required',
                'detail_address' => 'required'
            ],[
                'name.required' => '用户名不能为空',
                'tel.required' => '电话号码不能为空',
                'tel.numeric' => '电话号码只能为数字',
                'tel.digits_between' => '电话号码格式不对',
                'provence.required' => '省份不能为空',
                'city.required' => '市级不能为空',
                'area.required' => '县级不能为空',
                'detail_address.required' => '详细地址不能为空',
            ]);

        if($validator->fails()){
            return ['status' => 'false','message' => implode(' ',$validator->errors()->all()),];
        }
//        dd($request->provence);
        //验证通过，写入数据表
        Address::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'tel' => $request->tel,
            'provence' => $request->provence,
            'city' => $request->city,
            'area' => $request->area,
            'detail_address' => $request->detail_address,
            'is_default' => 0,
        ]);

        return ['status' => 'true','message' => '新增地址成功'];

    }

    // 指定地址接口
    public function address(Request $request){
        $address = Address::select('id','provence','city','area','detail_address','name','tel')->where('id',$request->id)->first();
        return $address;
    }

    //修改地址
    public function editAddress(Request $request){

        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'tel' => 'required|numeric|digits_between:11,11',//电话号码格式
                'provence' => 'required',
                'city' => 'required',
                'area' => 'required',
                'detail_address' => 'required'
            ],[
                'name.required' => '用户名不能为空',
                'tel.required' => '电话号码不能为空',
                'tel.numeric' => '电话号码只能为数字',
                'tel.digits_between' => '电话号码格式不对',
                'provence.required' => '省份不能为空',
                'city.required' => '市级不能为空',
                'area.required' => '县级不能为空',
                'detail_address.required' => '详细地址不能为空',
            ]);

        if($validator->fails()){
            return ['status' => 'false','message' => implode(' ',$validator->errors()->all()),];
        }

        //验证通过,修改信息
//        dd($request->id);
        Address::where('id',$request->id)->update([
            'provence' => $request->provence,
            'city' => $request->city,
            'area' => $request->area,
            'detail_address' => $request->detail_address,
            'tel' => $request->tel,
            'name' => $request->name,
            'is_default' => 0,
        ]);

        return ['status' => 'true','message' => '修改地址成功'];

    }


    //保存购物车接口
    public function addCart(Request $request){
        for($i=0;$i<count($request->goodsList);$i++){
            Carts::create([
                'user_id' => Auth::user()->id,
                'goods_id' => $request->goodsList[$i],
                'amount' => $request->goodsCount[$i],
            ]);
        }

        return ['status' => 'true','message' => '添加成功'];
    }


    //获取购物车列表接口
    public function cart(){

        //声明数组，用于保存返回数据
        $data = [];
        //购物车数据（当前登录用户）
        $carts = Carts::select('id','user_id','goods_id','amount')->where('user_id',Auth::user()->id)->get();
        //声明数组元素 totalCost 为总价格 0
        $data['totalCost'] = 0;
        //遍历购物车数据用商品ID来读取商品表中的商品数据
        foreach($carts as $cart){
            //购物车对应商品数据
            $goodsList = Menus::select('id','goods_name','goods_img','goods_price')->where('id',$cart->goods_id)->first();
            //获取对应返回值goods_id
            $goodsList['goods_id'] = $goodsList->id;
            //获取对应的商品数量
            $goodsList['amount'] = $cart->amount;
            //计算对应商品记录的价格
            $goodsList['goods_price'] = $cart->amount * $goodsList->goods_price;
            //删除多余元素id
            unset($goodsList['id']);
            //计算商品总价格
            $data['totalCost'] += $goodsList->goods_price;
            //将商品最终信息列入goods_list 下
            $data['goods_list'][] = $goodsList;
        }
        //返回最终购物车数据
        return $data;

    }


    // 添加订单接口
    public function addorder(Request $request){
        //生成订单随机编号
        $sn = date('Ymd').uniqid();
        //生成第三方交易号
        $out_trade_no = uniqid();
        //总价格
        $moneys=0;
        //获取地址信息
        $address=Address::select('provence','city','area','detail_address','tel','name')
            ->find($request->address_id);
        //获取购物车信息 购物车id 购物车商品id 购物车商品数量
        $cart=Carts::select('id','goods_id','amount')
            ->where('user_id',Auth::user()->id)
            ->get();
//        return $cart;
        //开启事务
        DB::beginTransaction();
        $a = Orders::create([
            'user_id' => Auth::user()->id,
            'shop_id' =>0,
            'sn' => $sn,
            'province' =>$address->provence,
            'city' => $address->city,
            'county' => $address->area,
            'address' => $address->detail_address,
            'tel' => $address->tel,
            'name' => $address->name,
            'total'=> $moneys,
            'status' => 0,//默认待支付
            'out_trade_no' => $out_trade_no,
        ]);


        foreach ($cart as $menu){
            //获取商品信息 商品id 商品名字 商品图片 商品价格
//            return $menu;
            $shop=Menus::select('shop_id','goods_name','goods_img','goods_price')
                ->find($menu->goods_id);

            $moneys += $shop->goods_price * $menu->amount;//计算总价格
            $shop_id = $shop->shop_id;//商家id

            $b = OrderDetails::create([
                'order_id' => $a->id,
                'goods_id' => $menu->goods_id,
                'amount' => $menu->amount,
                'goods_name' => $shop->goods_name,
                'goods_img' => $shop->goods_img,
                'goods_price' => $shop->goods_price,
            ]);
        }

        $a->shop_id=$shop_id;
        $a->total = $moneys;
        $c=$a->save();

        if($a&&$b&&$c){
            DB::commit();
            Carts::where('user_id',Auth::user()->id)->delete();
            return ['status' => 'true','message' => '添加成功','order_id' => $a->id];
        }else{
            DB::rollback();
            return ['status' => 'false','message' => '添加失败','order_id' => 0];
        }

        //订单生成成功发送短信
        $this->tips($sn);
    }

    //获取指定订单数据接口
    public function order(Request $request){
        //根据订单 id 获取订单信息 id 订单编号 创建时间 状态 商品id 总价 省 市 区 详细地址 取别名
        $order = Orders::select('id','sn as order_code','created_at as order_birth_time','status as order_status','shop_id','total as order_price','province','city','county','address')
            ->find($request->id)
            ->toArray();
        //生成详细的地址
        $order['order_address'] = $order['province'].$order['city'].$order['county'].$order['address'];
        //生成删除多余地址信息
        unset($order['province'],$order['city'],$order['county'],$order['address']);
        //替换订单状态
        switch ($order['order_status']){
            case -1:
                $order['order_status'] = '已取消';
                break;
            case 0:
                $order['order_status'] = '待支付';
                break;
            case 1:
                $order['order_status'] = '待发货';
                break;
            case 2:
                $order['order_status'] = '待确认';
                break;
            case 3:
                $order['order_status'] = '完成';
                break;
        }
        //根据订单id查询订单商品表详细信息
        $order['goods_list'] = OrderDetails::select('goods_id','goods_name','goods_img','amount','goods_price')
            ->where('order_id',$order['id'])
            ->get()
            ->toArray();
        //根据订单id查询 订单商品详细信息 商品id 名字 图片 数量 价格 后转换为数组
        $shops = Shops::select('shop_name','shop_img')->find($order['shop_id'])->toArray();
        //将订单信息与商家信息合并
        $data = array_merge($order,$shops);
        //返回数据
        return $data;
    }

    //订单列表接口
    public function orderList(){
        $data = [];
        //获取订单信息 id 订单编号 创建时间 状态 商品id 总价 省 市 区 详细地址 取别名
        $orders = Orders::select('id','sn as order_code','created_at as order_birth_time','status as order_status','shop_id','total as order_price','province','city','county','address')
            //根据id查询此账号的订单有哪些
            ->where('user_id',Auth::user()->id)
            ->get()
            //转化为数据
            ->toArray();
        //获取订单商品信息
        foreach ($orders as $order){
            //生成详细的地址
            $order['order_address'] = $order['province'].$order['city'].$order['county'].$order['address'];
            //生成删除多余地址信息
            unset($order['province'],$order['city'],$order['county'],$order['address']);
            //根据值替换订单状态
            switch ($order['order_status']){
                case -1:
                    $order['order_status'] = '已取消';
                    break;
                case 0:
                    $order['order_status'] = '待支付';
                    break;
                case 1:
                    $order['order_status'] = '待发货';
                    break;
                case 2:
                    $order['order_status'] = '待确认';
                    break;
                case 3:
                    $order['order_status'] = '完成';
                    break;
            }
            //根据订单id查询 订单商品详细信息 商品id 名字 图片 数量 价格 后转换为数组
            $order['goods_list'] = OrderDetails::select('goods_id','goods_name','goods_img','amount','goods_price')->where('order_id',$order['id'])->get()->toArray();
            //根据订单表的商家id 查询商家名字 图片
            $shops = Shops::select('shop_name','shop_img')->find($order['shop_id'])->toArray();
            //将订单信息与商家信息合并
            $data[] = array_merge($order,$shops);

        }
        //返回数据
        return $data;

    }

    public function tips($sn){
        $sn = substr($sn,8,4);

        // 短信应用SDK AppID
        $appid = 1400189795; // 1400开头

        // 短信应用SDK AppKey
        $appkey = "f0f379ddda7c39e41088a3881b20cb35";

        // 需要发送短信的手机号码
        $phoneNumber = Auth::user()->tel;

        // 短信模板ID，需要在短信应用中申请
        $templateId = 290426;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "firstyun"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = ['***'.$sn.'***'];//编号订单

            //发送短信
            $result = $ssender->sendWithParam(
                "86",
                $phoneNumber,
                $templateId,
                $params,
                $smsSign,
                "",
                ""
            );  // 签名参数未提供或者为空时，会使用默认签名发送短信

            $rsp = json_decode($result);
            dd($rsp);
            return $rsp;

        } catch(\Exception $e) {
            echo var_dump($e);
            //获取验证码失败
            return ['status'=>'false','message' => '获取验证码失败'];
        }
        //获取验证码成功
        return ['status'=>'true','message' => '获取验证码成功'];
    }

}
























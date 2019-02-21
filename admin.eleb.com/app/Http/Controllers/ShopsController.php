<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use App\Models\Shops;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //商家信息列表
    public function index(Request $request){
        $shops=Shops::all();
        return view('Shops.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shops = Shops::all();
        $shopcategory = ShopCategory::all();
        return view('Shops.create',compact('shopcategory','shops'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //商家账号
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',



        //商家信息
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_img'=>'required|image|max:2048',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
            //上传图片验证，最大2m ->2048kb

        ],[
            //商家账号
            'name.required'=>'名字不能为空',
            'email.required'=>'邮箱不能为空',
            'password.required'=>'密码不能为空',





            //商家信息表
            'shop_category_id.required'=>'店铺分类ID不能为空',
            'shop_name.required'=>'名字不能为空',
            'shop_img.required'=>'店铺图片不能为空',
            'shop_img.image'=>'图片格式不正确',
            'shop_img.max'=>'图片大小不能超过100K',
            'on_time.required'=>'名字不能为空',
            'brand.required'=>'名字不能为空',
            'fengniao.required'=>'名字不能为空',
            'start_send.required'=>'起送金额不能为空',
            'send_cost.required'=>'配送费不能为空',
            'notice.required'=>'店公告不能为空',
            'discount.required'=>'优惠信息不能为空',

        ]);
        //dd($request);

        //back()->withInput()
        //获取上传的文件，并保存到服务器
        $img = $request->file('shop_img');
        //保存文件
        $path = $img->store('public/shops');
        //dd($path);




        //验证通过，保存商家信息
        $a=Shops::create([
            //
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'shop_rating'=>$request->shop_rating,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'name'=>$request->name,
            'status'=>$request->status
        ]);
        $id=$a->id;
        //dd($request->statues);
        //验证通过，保存商家账号
        Users::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'shop_id'=>$id,
            'statues'=>$request->statues,

        ]);


        return redirect()->route('shops.index')->with('success','注册成功');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shops $shop)
    {
        //
        //dd($shops);
        $shop->delete();
        session()->flash('success','信息删除成功');
        return redirect()->route('shops.index');
    }
}

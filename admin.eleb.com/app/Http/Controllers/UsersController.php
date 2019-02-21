<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $users=Users::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $user)
    {
        //
        $shops = Shops::all();
        return view('users.edit',compact('shops','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Users $user,Request $request)
    {
        //

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'email.required'=>'邮箱不能为空',
            'password.required'=>'密码不能为空',
        ]);

        //验证通过，保存数据
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'shop_id'=>$request->shop_id,
            'statues'=>$request->statues,
        ]);


        //设置操作提示信息
        $request->session()->flash('success','用户修改成功');
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $user)
    {
        //
        $user->delete();
        session()->flash('success','分类删除成功');
        return redirect()->route('shopcategory.index');
    }
}

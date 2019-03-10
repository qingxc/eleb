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
        $shops = Shops::all();
        $users=Users::all();
        return view('users.index',compact('users','shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Users $user,Request $request)
    {
        //var_dump($user->name) ;exit;
        //dd($user->name);
        //$cz = mt_rand(1,999999).'cz';
        //验证通过，保存数据
//        $users=new Users();
//        $users->name = $user->name;
//        //dd($request->psaaword);
//        $cz = mt_rand(1,999999).'cz';
//        $users->password = Hash::make($cz);
//        $users->email = $user->email;
//        $users->shop_id = $user->shop_id;
//        $users->statues = 0;
//        $users->save();
        $a=$user->update([
            'name'=>$user->name,
            'email'=>$user->email,
            'password'=>Hash::make('123456cz'),
            'shop_id'=>$user->shop_id,
            'statues'=>0,
        ]);
        //dd($a->statues);

        //设置操作提示信息
        $request->session()->flash('success',"用户密码重置成功,请记住新密码"."123456cz");
        return redirect()->route('users.index');

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
    public function show(Users $user,Request $request)
    {
        return redirect()->route('users.index');
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
        $a=$user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'shop_id'=>$request->shop_id,
            'statues'=>1,
        ]);
        //dd($a->statues);

        //设置操作提示信息
        $request->session()->flash('success','用户审核成功');
        return redirect()->route('users');

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
        session()->flash('success','分类成功');
        return redirect()->route('users.index');
    }
}

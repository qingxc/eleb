<?php

namespace App\Http\Controllers;


use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('users.create');
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
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'标题不能为空',
            'password.required'=>'密码不能为空',
            'email'=>'邮箱不能为空',
        ]);


        //验证通过，保存数据
//        var_dump($request->password);

        $user = new Users();
        $user->name = $request->name;
//        dd($request->password);
        $user->password = Hash::make($request->password);
        $user->statues=0;
        $user->email = $request->email;
        $user->save();
        //dd('ok');
//        Admins::create([
//            'name'=>$request->name,
//            'password'=>Hash::make($request->psaaword),
//            'email'=>$request->email,
//        ]);
        return redirect()->route('users.index')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users )
    {
        //
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
        return view('users.edit',compact('gclasses','user'));
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
        //接收表单数据
        //数据验证，验证不通过，返回表单并提示错误信息
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'标题不能为空',
            'password.required'=>'内容不能为空',
            'email'=>'邮箱不能为空',
        ]);

        //
        if (Hash::check($request->oldpassword, $user->password)) {
            //验证通过，保存数据
            $user->update([
                'name'=>$request->name,
                'password'=>Hash::make($request->password),
                'email'=>$request->email,
            ]);
            //设置操作提示信息
            $request->session()->flash('success','修改成功');
            return redirect()->route('users.index');
        }else{
            $request->session()->flash('danger','修改失败,旧密码有误');
            return redirect()->route('users.index');
        }







    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $user)
    {
        $user->delete();
        session()->flash('success','管理员删除成功');
        return redirect()->route('users.index');
    }
}

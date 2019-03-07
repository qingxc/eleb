<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $admins=Admins::all();
        return view('admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rows=Role::all();
        return view('admins.create',compact('rows'));
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
            'password.required'=>'内容不能为空',
            'email'=>'邮箱不能为空',
        ]);
        $admins=Admins::create([
            'name'=>$request->name,
            'password'=>Hash::make($request->psaaword),
            'email'=>$request->email,
        ]);
        //添加管理员角色
        $admins->syncRoles($request->permission);
        return redirect()->route('admins.index')->with('success','管理员添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admins $admin )
    {
        //
        return view('admin.edit',compact('gclasses','admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admins $admin)
    {
        $rows=Role::all();
        $roles=$admin->getRoleNames();
        return view('admins.edit',compact('rows','admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Admins $admin,Request $request)
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
        if (Hash::check($request->oldpassword, $admin->password)) {
            //验证通过，保存数据
            $admin->update([
                'name'=>$request->name,
                'password'=>Hash::make($request->psaaword),
                'email'=>$request->email,
            ]);
            //设置操作提示信息
            $request->session()->flash('success','管理员修改成功');
            return redirect()->route('admins.index');
        }else{
            $request->session()->flash('danger','管理员修改失败,旧密码有误');
            return redirect()->route('admins.index');
        }







    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(admins $admin)
    {
        $admin->delete();
        session()->flash('success','管理员删除成功');
        return redirect()->route('admins.index');
    }
}

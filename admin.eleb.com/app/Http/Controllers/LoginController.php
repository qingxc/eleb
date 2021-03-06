<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    //登录表单
    public function index(){
        return view('Login.index');
    }


    //登录功能
    public function login(Request $request){
        /*$admin = new Admins();
        $admin->name = 'zhangsan';
        $admin->password = Hash::make('123456');
        $admin->email = '123';
        $admin->save();
        dd('ok');*/
        $this->validate($request,
            [
                'name' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => '用户名不能为空',
                'password.required' => '密码不能为空',
            ]
        );
//        $admin = Admins::find(9);
//        $r=Hash::check($request->password,$admin->password);
//        dd($r);
        if(Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])){
            return redirect()->route('admins.index')->with('success','登录成功');
        }

        return back()->with('danger','登录失败,用户名或密码不正确');
    }

    //退出登录
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出登录成功');
    }
}

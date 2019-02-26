<?php

namespace App\Http\Controllers;


use App\Models\Activity;
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
                //'statues' =>0
            ],
            [
                'name.required' => '用户名不能为空',
                'password.required' => '密码不能为空',
                //'statues.0'=>'用户未审核'
            ]
        );
//        $admin = Admins::find(9);
//        $r=Hash::check($request->password,$admin->password);
//        dd($r);
//        var_dump($request);exit;
//        if($request->statues!=1){
//            return back()->with('danger','登录失败,用户未验证');
//        }else
            if(Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
            'statues'=>1
        ])){
            return redirect()->route('users.index')->with('success','登录成功');
        }

        return back()->with('danger','登录失败,用户名或密码不正确或者未审核');
    }

    //退出登录
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出登录成功');
    }

    public function show()
    {
        $date= date('Y-m-d H:i:s');

        $wheres=[];
        $wheres[] = ['start_time','<=',$date];
        $wheres[] = ['end_time','>=',$date];
        $activity = Activity::where($wheres)->get();
        return view('login.shows',compact('activity'));
    }

    public function shows(Activity $activity)
    {
        //dd($request);
        return view('login.show',compact('activity'));
    }


}

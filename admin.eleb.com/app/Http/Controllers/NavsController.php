<?php

namespace App\Http\Controllers;

use App\Models\Navs;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $navs=Navs::paginate(7);
        return view('navs.index',compact('navs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=Permission::all();
        $rows=Navs::all();
        return view('navs.create',compact('rows','data'));
    }


    public function store(Request $request)
    {
//        dd($request->pid);
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'url.required'=>'url不能为空',
        ]);
//        dd($request->name);
        Navs::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id,
//            'pid'=>$request->pid,
        ]);
        return redirect()->route('navs.index')->with('success','添加成功');
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
    public function edit(Navs $nav,Request $request)
    {
        $rows=Navs::all();
        $data=Permission::all();
        return view('navs.edit',compact('rows','nav','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Navs $nav,Request $request){
//dd($request->pid);
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',

        ],[
            'name.required'=>'名字不能为空',
            'url.required'=>'url不能为空',

        ]);


//        dd($request->permission_id);
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id,
        ]);
        $request->session()->flash('success','修改成功');
        return redirect()->route('navs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navs $nav){
        $nav->delete();
        session()->flash('success','删除成功');
        return redirect()->route('navs.index');
    }
}

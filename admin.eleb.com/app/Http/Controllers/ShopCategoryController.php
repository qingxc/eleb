<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shopcategory = ShopCategory::all();
        return view('shopcategory.index',compact('shopcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('shopcategory.create');
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
            'status'=>'required',
            //上传图片验证，最大2m ->2048kb

        ],[
            'name.required'=>'名字不能为空',
            'status.required'=>'状态不能为空',

        ]);


        //验证通过，保存数据
        ShopCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$request->shop_img
        ]);
        return redirect()->route('shopcategory.index')->with('success','分类添加成功');
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
    public function edit(ShopCategory $shopcategory )
    {
        //
        return view('shopcategory.edit',compact('gclasses','shopcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopCategory $shopcategory,Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',

        ],[
            'name.required'=>'名字不能为空',
            'status.required'=>'状态不能为空',

        ]);


        //验证通过，保存数据
        $shopcategory->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$request->shop_img
        ]);


        //设置操作提示信息
        $request->session()->flash('success','用户修改成功');
        return redirect()->route('shopcategory.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopCategory $shopcategory)
    {
        //
        $shopcategory->delete();
        session()->flash('success','分类删除成功');
        return redirect()->route('shopcategory.index');
    }
}

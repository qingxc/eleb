<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\Menus;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //$shop=Shops::all();
        //MenuCategory::all();
//        $menucategory=DB::select('select * from menu_categories where shop_id=?',[Auth::user()->id]);

        $menucategory=MenuCategory::where('shop_id',Auth::user()->id)->get();
//        dd($menucategory);
        return view('menucategory.index',compact('menucategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('menucategory.create');
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
            'type_accumulation'=>'required',
            'shop_id'=>'required',
            'description'=>'required',

        ],[
            'name.required'=>'名称不能为空',
            'type_accumulation.required'=>'菜品编号不能为空',
            'shop_id.required'=>'所属商家ID不能为空',
            'description.required'=>'描述不能为空',


        ]);


        //验证通过，保存数据
        //var_dump(Auth::user()->id);exit;
        if($request->is_selected==1){
            $a=$request->shop_id;
            DB::update('update menu_categories set is_selected=0 where is_selected=1 and shop_id=?',[Auth::user()->shop_id]);
        }
        $menucategory = new MenuCategory();
        $menucategory->name = $request->name;
        //dd($request->psaaword);
        $menucategory->type_accumulation = $request->type_accumulation;
        $menucategory->shop_id = $request->shop_id;
        $menucategory->description = $request->description;
        $menucategory->is_selected = $request->is_selected;
        $menucategory->save();
        //dd('ok');

//                MenuCategory::create([
//            'name'=>$request->name,
//            'name'=>$request->type_accumulation,
//            'name'=>$request->shop_id,
//            'name'=>$request->description,
//            'name'=>$request->is_selected,
//
//        ]);


//        Admins::create([
//            'name'=>$request->name,
//            'password'=>Hash::make($request->psaaword),
//            'email'=>$request->email,
//        ]);
        return redirect()->route('menucategory.index')->with('success','添加成功');
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
    public function edit(MenuCategory $menucategory)
    {
        //var_dump($menucategory->name);exit;
        //
        return view('menucategory.edit',compact('menucategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuCategory $menucategory,Request $request)
    {
        //dd($request->name);
        //修改分类
        $this->validate($request,[
            'name'=>'required',
            'type_accumulation'=>'required',
            'shop_id'=>'required',
            'description'=>'required',

        ],[
            'name.required'=>'名称不能为空',
            'type_accumulation.required'=>'菜品编号不能为空',
            'shop_id.required'=>'所属商家ID不能为空',
            'description.required'=>'描述不能为空',


        ]);

        if($request->is_selected==1){
            $a=$request->shop_id;
            DB::update('update menu_categories set is_selected=0 where shop_id=?',[Auth::user()->id]);
        }




        $menucategory->update([
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'shop_id'=>$request->shop_id,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected
                        ]);

        //设置操作提示信息
        $request->session()->flash('success','用户审核成功');
        return redirect()->route('menucategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuCategory $menucategory)
    {
        //
        if($menucategory=Menus::where('shop_id',Auth::user()->id)
            ->where('category_id',$menucategory->id)){
            session()->flash('success','不是空目录不能删除');
            return redirect()->route('menucategory.index');
        }
        ;
        $menucategory->delete();
        session()->flash('success','信息删除成功');
        return redirect()->route('menucategory.index');
    }
}

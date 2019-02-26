<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //var_dump($request->id);exit;
        //echo 123;exit;
        $rows = Menus::where('shop_id',Auth::user()->shop_id)
            ->where('category_id',$request->id);

        //如果有名称查询
        if($keyword = $request->keyword){
            $rows->where('goods_name','like',"%{$keyword}%");
        }
        //如果有最小
        if($min = $request->min){
            $rows->where('goods_price','>=',$min);
        }
        //如果有最大
        if($max = $request->max){
            $rows->where('goods_price','<=',$max);
        }
        //最后查询
        $rows = $rows->paginate(1);
        //菜品分类列表
        return view('Menus.index',compact('rows','request'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //获取所有菜品分类
        $rows = MenuCategory::all()->where('shop_id',Auth::user()->shop_id);
        //添加表单页面
        return view('menus.create',compact('rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'goods_name' => 'required',//名称
                'rating' => 'required|numeric',//评分
                'goods_price' => 'required|numeric',//价格
                'tips' => 'required',//提示信息
                'goods_img' => 'required|image|max:2048',//图片
                'description' => 'required',//描述
            ],
            [
                'goods_name.required' => '菜品名称不能为空',
                'goods_img.required' => '图片不能为空',
                'goods_img.image' => '请上传图片格式的文件',
                'goods_img.max' => '请上传图片大小超过2M',
                'rating.required' => '评分不能为空',
                'rating.numeric' => '评分只能为数字',
                'goods_price.required' => '菜品价格不能为空',
                'goods_price.numeric' => '菜品价格只能为数字',
                'tips.required' => '提示信息不能为空',
                'description.required' => '描述不能为空',
            ]);
        $img = $request->file('goods_img');
//        //保存文件
        $path = $img->store('public/menus');
        //$path = Storage::url($request->file('goods_img')->store('public/MenuImages'));//上传图片

        //验证通过
        Menus::create([
            'goods_name' => $request->goods_name,
            'rating' => $request->rating,
            'shop_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => 0,
            'rating_count' => 0,
            'tips' => $request->tips,
            'satisfy_count' => 0,
            'satisfy_rate' => 0,
            'goods_img' => $path,
            'status' => $request->status,
        ]);

        //添加成功
        return redirect()->route('menus.index')->with('success','新增菜品成功！');
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
    public function edit(Menus $menu)
    {
        $rows = MenuCategory::all()->where('shop_id',Auth::user()->shop_id);
        //更新表单页面
        return view('Menus.edit',compact('menu','rows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menus $menu)
    {
        //
        $this->validate($request,
            [
                'goods_name' => 'required',//名称
                'rating' => 'required|numeric',//评分
                'goods_price' => 'required|numeric',//价格
                'tips' => 'required',//提示信息
                'goods_img' => 'image|max:2048',//图片
                'description' => 'required',//描述
            ],
            [
                'goods_name.required' => '菜品名称不能为空',
                'goods_img.image' => '请上传图片格式的文件',
                'goods_img.max' => '请上传图片大小超过2M',
                'rating.required' => '评分不能为空',
                'rating.numeric' => '评分只能为数字',
                'goods_price.required' => '菜品价格不能为空',
                'goods_price.numeric' => '菜品价格只能为数字',
                'tips.required' => '提示信息不能为空',
                'description.required' => '描述不能为空',
            ]);

        $path = $menu->goods_img;
        if($img = $request->file('goods_img')){
            $path = Storage::url($request->file('goods_img')->store('public/MenuImages'));//上传图片
        }

        //验证通过
        $menu->update([
            'goods_name' => $request->goods_name,
            'rating' => $request->rating,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'tips' => $request->tips,
            'goods_img' => $path,
            'status' => $request->status,
        ]);

        //添加成功
        return redirect()->route('menus.index')->with('success','更新菜品成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menus $menu)
    {
        //删除
        $menu->delete();

        return redirect()->route('menus.index')->with('success','删除菜品成功！');
    }

    public function status(Menus $menu){
        //默认为启用
        $status = 1;
        $str = '启用成功';

        if($menu->status){//禁用
            $status = 0;
            $str = '禁用成功';
        }

        //修改状态数据
        $menu->update([
            'status' => $status,
        ]);

        return redirect()->route('menu.index')->with('success',$str);

    }
}

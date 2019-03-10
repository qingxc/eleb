<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RbacJsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $rbacjs=Role::all();
        return view('rbacjs.index',compact('rbacjs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rows=Permission::all();
        return view('rbacjs.create',compact('rows'));
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
//        dd($request->permission);
        $role = Role::create(['name' =>$request->name]);
        //给角色赋予权限
        $role->givePermissionTo($request->permission);
        return redirect()->route('rbacjs.index')->with('success','角色添加成功');
    }


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
    public function edit(Role $rbacj,Request $request)
    {
        //

        $rows=Permission::all();
        $permissions  = $rbacj->getAllPermissions();

        return view('rbacjs.edit',compact('rows','rbacj','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $rbacj,Request $request)
    {

        $rbacj->update([
            'name' => $request->name
        ]);

        //赋予权限
        if($request->role){
            $rbacj->syncPermissions($request->role);
        }

        return redirect()->route('rbacjs.index')->with('success','更新角色成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $rbacj,Request $request)
    {
        $rbacj->delete();
        session()->flash('success','删除成功');
        return redirect()->route('rbacjs.index');
    }
}

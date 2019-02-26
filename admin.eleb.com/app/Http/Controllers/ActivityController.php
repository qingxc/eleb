<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date= date('Y-m-d H:i:s');

        $wheres=[];
        if($request->status == 1 ){
            $wheres[] = ['start_time','>=',$date];
        }

//进行中
        if($request->status == 2){
            $wheres[] = ['start_time','<=',$date];
            $wheres[] = ['end_time','>=',$date];
        }

//已结束
        if($request->status == 3){
            //dd($request->status);
            $where[]=['end_time','>=',$date];
        }
        $activity = Activity::where($wheres)->get();
            return view('activity.index',compact('activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
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
            'title'=>'required',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',

        ],[
            'title.required'=>'名字不能为空',
            'content.required'=>'详情不能为空',
            'start_time.required'=>'开始时间不能空',
            'end_time.required'=>'结束时间不能空',

        ]);

        Activity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,

        ]);
        return redirect()->route('activity.index')->with('success','活动添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
        return view('activity.show',compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
        return view('activity.edit',compact('gclasses','activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Activity $activity)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',

        ],[
            'title.required'=>'名字不能为空',
            'content.required'=>'详情不能为空',
            'start_time.required'=>'开始时间不能空',
            'end_time.required'=>'结束时间不能空',
        ]);
        //验证通过，保存数据
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        $request->session()->flash('success',"修改活动成功");
        return redirect()->route('activity.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
        $activity->delete();
        session()->flash('success','删除成功');
        return redirect()->route('activity.index');
    }
}

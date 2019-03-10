<?php

namespace App\Http\Controllers;

use App\Models\EventMembers;
use App\Models\Events;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventmembers=EventMembers::all();
        return view('eventmembers.index',compact('eventmembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $events=Events::all();
        $shops=Shops::all();
        return view('eventmembers.create',compact('events','shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Events $event)
    {
        //
        $this->validate($request,[
            'events_id'=>'required',
            'member_id'=>'required',
        ],[
            'events_id.required'=>'未选择活动',
            'member_id.required'=>'请选择店铺',
        ]);
       $eventmembers = EventMembers::select('member_id')->get();

//        dd($eventmembers->member_id);
        $events=Events::select('signup_num','num')->where('id',$request->events_id)->get();
        foreach ($events as $event){
//            dd($event->signup_num);
            if($event->signup_num < $event->num){
                return redirect()->route('users.index')->with('danger','名额已满');
            }
        }

        foreach($eventmembers as $v){
//            dd($v->member_id);
            if($v->member_id==$request->member_id){
                return redirect()->route('users.index')->with('danger','请勿重复报名');
            }
        }

//        $sql=DB::update("update events set num=$event->num+1 where events_id=",[$event->id]);
//        var_dump($sql);exit;
        EventMembers::create([
            'events_id'=>$request->events_id,
            'member_id'=>$request->member_id,
        ]);

        return redirect()->route('users.index')->with('success','添加成功');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

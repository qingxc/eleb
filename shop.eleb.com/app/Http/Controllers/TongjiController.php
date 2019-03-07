<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TongjiController extends Controller
{
    //订单列表
    public function index(){
        $rows=Orders::where('shop_id',Auth::user()->id)->get();
        return view('tongji.index',compact('rows'));
    }

    //订单详情
    public function show()
    {

    }


    public function edit(Request $request){
//        var_dump($orders->id);exit;
        DB::update('update orders set status=-1 where shop_id=?',[Auth::user()->id]);
//        $orders->update([
//            'status'=> -1,
//        ]);
        $request->session()->flash('success','订单已取消');
        return redirect()->route('tongji.index');
    }


    public function edit2(Request $request){
        DB::update('update orders set status=2 where shop_id=?',[Auth::user()->id]);
        $request->session()->flash('success','订单已发货,待确认.');
        return redirect()->route('tongji.index');
    }


    //按周统计订单量
    public function tongjiz(Request $request){
        $data1[]=0;
        $data2[]=0;
        for($n=0;$n>=-6;$n--){
            $day=date("Y-m-d",strtotime("$n day"));
            $row=Orders::where('created_at','like',"%$day%")->count();
//            echo $day;
            $data1[]=$day;
            $data2[]=$row;
            }

        return view('tongji.tongjiz',compact('data1','data2'));
    }



    //按月统计订单量
    public function tongjiy(Request $request){
        $data1[]=0;
        $data2[]=0;
        for($n=0;$n>=-2;$n--){
            $month=date("Y-m-d",strtotime("$n month"));
            $row=Orders::where('created_at','like',"%$month%")->count();
//            echo $month;
            $data1[]=$month;
            $data2[]=$row;
        }

        return view('tongji.tongjiz',compact('data1','data2'));
    }

    //按周统计订菜品单量
    public function tongjizc(Request $request){
        $menuWeek = [];
        $data = [];
        for($i=0;$i<=6;$i++){
            $date = date('Y-m-d',strtotime("-$i day"));
            $menuWeek[$date] = DB::select('select goods_id,sum(amount) as num from order_details join menuses on order_details.goods_id = menuses.id where menuses.shop_id = ? and order_details.created_at like ? GROUP BY goods_id ',[Auth::user()->id,"$date%"]);
            foreach ($menuWeek[$date] as $row){
                $row->goods_name = Menus::select('goods_name')->find($row->goods_id)->toArray()['goods_name'];
                unset($row->goods_id);
            }
        }
        $str = [];
        foreach($menuWeek as $menu){
            foreach($menu as $m){
                $str[] = $m->goods_name;
            }
        }
        foreach ($str as $row){
            $data[$row] = array_keys($menuWeek);
            $data[$row] = array_flip($data[$row]);
        }
        foreach($data as $rowK => &$rowV){
            foreach($rowV as $k => &$v){
                foreach($menuWeek[$k] as $m){
                    if($m->goods_name == $rowK){
                        $v = $m->num;
                    }
                }
            }
        }
        foreach($data as &$row){
            foreach($row as &$r){
                if(gettype($r) == 'integer'){
                    $r = '0';
                }
            }
        }
//        dd($data);
        return view('tongji.tongjizc',compact('data'));
    }


    //按月统计订菜品单量
    public function tongjiyc(Request $request){
        $menuWeek = [];
        $data = [];
        for($i=0;$i<=2;$i++){
            $date = date('Y-m',strtotime("-$i month"));
            $menuWeek[$date] = DB::select('select goods_id,sum(amount) as num from order_details join menuses on order_details.goods_id = menuses.id where menuses.shop_id = ? and order_details.created_at like ? GROUP BY goods_id ',[Auth::user()->id,"$date%"]);
            foreach ($menuWeek[$date] as $row){
                $row->goods_name = Menus::select('goods_name')->find($row->goods_id)->toArray()['goods_name'];
                unset($row->goods_id);
            }
        }
        $str = [];
        foreach($menuWeek as $menu){
            foreach($menu as $m){
                $str[] = $m->goods_name;
            }
        }
        foreach ($str as $row){
            $data[$row] = array_keys($menuWeek);
            $data[$row] = array_flip($data[$row]);
        }
        foreach($data as $rowK => &$rowV){
            foreach($rowV as $k => &$v){
                foreach($menuWeek[$k] as $m){
                    if($m->goods_name == $rowK){
                        $v = $m->num;
                    }
                }
            }
        }
        foreach($data as &$row){
            foreach($row as &$r){
                if(gettype($r) == 'integer'){
                    $r = '0';
                }
            }
        }
        return view('tongji.tongjiyc',compact('data'));
    }


}

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
    public function ngjizc(Request $request){
        //获取商家菜品信息
       $data = Menus::select('goods_name')->where('shop_id',Auth::user()->id)->get();

        //时间数组
        $data1[]='';
        //菜品名称数组
        $data2[]='';
        //循环遍历出菜品名字
        foreach ($data as $d){
            //将名字存入数组
             $data2[] = $d->goods_name;
            //菜品数量
            $number=0;
            $numbers[]='';
            for($n=0;$n>=-6;$n--) {
                //时间设置
                $day = date("Y-m-d", strtotime("$n day"));
                //查询出一周内每个菜品的次数
                $nob = OrderDetails::select('amount')->where('goods_name',"$d->goods_name")->where('created_at', 'like',"%$day%")->get();
                dd($nob);
                foreach ($nob as $no){

                    $number += $no->amount;
                    $numbers[] = $number;
                    $data1[] = $day;
                }


            }
            dd($numbers);
        }
        dd($data2);
        return view('tongji.tongjiz',compact('data1','data2','numbers'));//data1是xxxxxx data2 是菜品名字 numbers是数量
    }


    public function tongjizc(Request $request){

        //时间
        $data1[]=0;
        //数量集合
        $data2[]=0;
        //菜名
        $data3[]=0;
        for($n=0;$n>=-6;$n--){
            $day=date("Y-m-d",strtotime("$n day"));
//            $order=DB::select("select goods_name from order_details group by goods_name");
//            $sql=11;
            $sql="select goods_name,sum(amount) as am from order_details  where created_at like '$day%' group by goods_name";
            $order = DB::select("$sql");

//            var_dump($order);exit;
            foreach ($order as $k =>$v){
                $data22[]=$v->am;
                $data33[]=$v->goods_name;
            }
//            foreach ($data33 as $k=>$v){
//                if($v!=$ta){
//                    $ta[]=$v;
//                }
//            }
            $data1[]=$day;
            $data2[]=$data22;
            $data3[]=$data33;
        }
        array_shift($data1);
        array_shift($data2);
        array_shift($data3);
        $data1 = array_flip($data1);
        foreach($data1 as &$row){
            foreach ($data3 as $da=>&$d){
                $val=array_values($d);
                $row=array_flip($val);
                $i=0;
                foreach ($val as &$v){
                    if($data2[$i]){
                        $v = $data2[$i];
                    }else{
                        $v = '0';
                    }

                }
                $i++;
            }
        }
//        foreach ($data1 as $vv){
//
//        }
//        dd($data1);
        return view('tongji.tongjizc',compact('data1'));

    }


    //按月统计订菜品单量
    public function tongjiyc(Request $request){

    }


}

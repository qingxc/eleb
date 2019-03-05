@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户ID</th>
            <th>商家ID</th>
            <th>订单编号</th>
            <th>省</th>
            <th>市</th>
            <th>县</th>
            <th>详细地址</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>价格</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>第三方交易号</th>
            <th>操作</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->user_id }}</td>
                <td>{{ $row->shop_id }}</td>
                <td>{{ $row->sn }}</td>
                <td>{{ $row->province }}</td>
                <td>{{ $row->city }}</td>
                <td>{{ $row->county }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->tel }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->total }}</td>
                <td>@if($row->status == -1)
                        <button class="btn btn-default btn-xs">已取消</button>
                    @elseif($row->status == 0)
                        <button class="btn btn-primary btn-xs">待支付</button>
                    @elseif($row->status == 1)
                        <button class="btn btn-danger btn-xs">待发货</button>
                    @elseif($row->status == 2)
                        <button class="btn btn-warning btn-xs">待确认</button>
                    @elseif($row->status == 3)
                        <button class="btn btn-success btn-xs">已完成</button>
                    @endif</td>
                <td>{{ $row->created_at }}</td>
                <td>{{ $row->out_trade_no }}</td>
                <td>
                    <a href="{{ route('tongji.show',['id'=>$row->id]) }}" class="btn btn-info">查看订单</a>
                    <a href="{{ route('tongji.edit',[$row]) }}" class="btn btn-warning">取消订单</a>
                    <a href="{{ route('tongji.edit2',[$row]) }}" class="btn btn-warning">配置发货</a>
                </td>
            </tr>
        @endforeach
    </table>
@stop
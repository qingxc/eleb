@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>店铺分类ID</th>
            <th>名称</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>是否是品牌</th>
            <th>是否准时送达</th>
            <th>是否蜂鸟配送</th>
            <th>是否保标记</th>
            <th>是否票标记</th>
            <th>是否准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>店公告</th>
            <th>优惠信息</th>
            <th>状态:1正常,0待审核,-1禁用</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->id }}</td>
                <td>{{ $shop->shop_category_id }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td><img src="{{ $shop->shop_img }}" style=" height: 80px"></td>
                <td>{{ $shop->shop_rating?'是':'否' }}</td>
                <td>{{ $shop->brand?'是':'否' }}</td>
                <td>{{ $shop->on_time?'是':'否' }}</td>
                <td>{{ $shop->fengniao?'是':'否' }}</td>
                <td>{{ $shop->bao?'是':'否' }}</td>
                <td>{{ $shop->piao?'是':'否' }}</td>
                <td>{{ $shop->zhun?'是':'否' }}</td>
                <td>{{ $shop->start_send }}</td>
                <td>{{ $shop->send_cost }}</td>
                <td>{{ $shop->notice }}</td>
                <td>{{ $shop->discount }}</td>
                <td>{{ $shop->status }}</td>
                <td><a href="{{ route('shops.show',[$shop]) }}" class="btn btn-info">查看信息</a>
                    <a href="{{ route('shops.edit',[$shop]) }}" class="btn btn-warning">审核编辑</a>
                    <form style="display: inline" method="post" action="{{ route('shops.destroy',[$shop]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除店铺</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
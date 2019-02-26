@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属商家ID</th>
            <th>所属分类ID</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态：1上架，0下架</th>

            <th>操作</th>
        </tr>
{{--        {{ $request }}--}}
        {{ $rows }}
        @foreach($rows as $row)
{{--            {{ $row->name }}--}}
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->goods_name }}</td>
                <td>{{ $row->rating }}</td>
                <td>{{ $row->shop_id }}</td>
                <td>{{ $row->category_id }}</td>
                <td>{{ $row->goods_price }}</td>
                <td>{{ $row->description }}</td>
                <td>{{ $row->month_sales }}</td>
                <td>{{ $row->rating_count }}</td>
                <td>{{ $row->tips }}</td>
                <td>{{ $row->satisfy_count }}</td>
                <td>{{ $row->satisfy_rate }}</td>
                <td><img src="{{ $row->image() }}" style=" height: 80px"></td>
                <td>{{ $row->status==1?'默认':'否' }}</td>
                <td>
                    <a href="{{ route('menus.index',['id'=>$row->id]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('menus.edit',[$row]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('menus.destroy',[$row]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
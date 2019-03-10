@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>分类名</th>
            <th>头像</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
{{--        {{ dd($shopcategory) }}--}}
        @foreach($shopcategory as $shopcategor)
            <tr>
                <td>{{ $shopcategor->id }}</td>
                <td>{{ $shopcategor->name }}</td>
                <td><img src="{{$shopcategor->img}}" style=" height: 80px"></td>
                <td>{{ $shopcategor->status?'显示':'隐藏' }}</td>
                <td>
                    @can('分类列表')
                    <a href="{{ route('shopcategory.show',[$shopcategor]) }}" class="btn btn-info">查看</a>
                    @endcan
                    @can('修改分类')
                    <a href="{{ route('shopcategory.edit',[$shopcategor]) }}" class="btn btn-warning">编辑</a>
                    @endcan
                    @can('删除分类')
                    <form style="display: inline" method="post" action="{{ route('shopcategory.destroy',[$shopcategor]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
@stop
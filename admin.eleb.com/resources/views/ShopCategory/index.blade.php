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
        @foreach($shopcategory as $shopcategor)
            <tr>
                <td>{{ $shopcategor->id }}</td>
                <td>{{ $shopcategor->name }}</td>
                <td><img src="{{ $shopcategor->image() }}" style=" height: 80px"></td>
                <td>{{ $shopcategor->status?'显示':'隐藏' }}</td>
                <td><a href="{{ route('shopcategory.show',[$shopcategor]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('shopcategory.edit',[$shopcategor]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('shopcategory.destroy',[$shopcategor]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商家名</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->statues?'显示':'隐藏' }}</td>
                <td>{{ $user->shop_id }}</td>
                <td><a href="{{ route('users.show',[$user]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('users.edit',[$user]) }}" class="btn btn-warning">审核修改</a>
                    <a href="{{ route('users.create',[$user]) }}" class="btn btn-warning">重置密码</a>
                    <form style="display: inline" method="post" action="{{ route('users.destroy',[$user]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
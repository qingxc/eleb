@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('users.show',[$user]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('users.edit',[$user]) }}" class="btn btn-warning">编辑</a>
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
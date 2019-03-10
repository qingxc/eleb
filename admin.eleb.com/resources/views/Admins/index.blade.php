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
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    @can('查看管理员')
                    <a href="{{ route('admins.show',[$admin]) }}" class="btn btn-info">查看</a>
                    @endcan
                    @can('修改管理员')
                    <a href="{{ route('admins.edit',[$admin]) }}" class="btn btn-warning">编辑</a>
                        @endcan
                    <a href="{{ route('adminjs',[$admin]) }}" class="btn btn-warning">编辑角色</a>
                        @can('删除管理员')
                    <form style="display: inline" method="post" action="{{ route('admins.destroy',[$admin]) }}">
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
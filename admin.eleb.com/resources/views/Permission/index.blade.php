@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>权限名(路由)</th>
            <th>警卫名字</th>
            <th>操作</th>
        </tr>
        @foreach($rows as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>
                    <a href="{{ route('permission.edit',[$permission]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('permission.destroy',[$permission]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
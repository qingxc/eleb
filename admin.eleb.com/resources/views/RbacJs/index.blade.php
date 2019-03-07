@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>角色名</th>
            <th>警卫名字</th>
            <th>操作</th>
        </tr>
        @foreach($rbacjs as $rbacj)
            <tr>
                <td>{{ $rbacj->id }}</td>
                <td>{{ $rbacj->name }}</td>
                <td>{{ $rbacj->guard_name }}</td>
                <td>
                    <a href="{{ route('rbacjs.edit',[$rbacj]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('users.destroy',[$rbacj]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
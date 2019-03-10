@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>URL</th>
            <th>关联id</th>
            <th>父级id</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{ $nav->id }}</td>
                <td>{{ $nav->name }}</td>
                <td>{{ $nav->url }}</td>
                <td>{{ $nav->permission_id }}</td>
                <td>{{ $nav->pid }}</td>
                <td>
                    <a href="{{ route('navs.edit',[$nav]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('navs.destroy',[$nav]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
    <div>
        {{ $navs->links() }}
    </div>
@stop
@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>菜品编号</th>
            <th>所属商家ID</th>
            <th>描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
{{--        {{ $menucategory }}--}}
        @foreach($menucategory as $menucategor)
            <tr>
                <td>{{ $menucategor->id }}</td>
                <td>{{ $menucategor->name }}</td>
                <td>{{ $menucategor->type_accumulation }}</td>
                <td>{{ $menucategor->shop_id }}</td>
                <td>{{ $menucategor->description }}</td>
                <td>{{ $menucategor->is_selected==1?'默认':'否' }}</td>
                <td><a href="{{ route('menus.index',['id'=>$menucategor->id]) }}" class="btn btn-info">查看菜品</a>
                    <a href="{{ route('menucategory.edit',[$menucategor]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('menucategory.destroy',[$menucategor]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
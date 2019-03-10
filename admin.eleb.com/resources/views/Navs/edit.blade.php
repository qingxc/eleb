@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('navs.update',[$nav])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //echo $users;exit;?>
        <h1>菜单修改:</h1>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')??$nav->name }}">
        </div>
        <div class="form-group"  name="pid">
            <label>上级菜单(若是顶级菜单请选择顶级菜单)</label>
            <select class="form-control" name="pid">
                <option name="pid" value="0" selected>顶级菜单</option>
                @foreach($rows as $row)
                    @if($row->pid == 0)
                        <option name="pid" value="{{ $row->id }}">{{ $row->name }}{{ $row->id }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <p><label>权限:</label></p>
            @foreach($data as $row)
                <input type="radio" name="permission_id" value="{{$row->id }}"/>{{ $row->name }}
            @endforeach
        </div>
        <div class="form-group">
            <label>地址路由(URL,顶级可不填)</label>
            <input type="text" name="url" class="form-control" value="{{ old('url')??$nav->url }}">
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
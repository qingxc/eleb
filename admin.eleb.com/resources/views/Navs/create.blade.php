@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加菜单</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('navs.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>上级菜单(若是顶级菜单请选择顶级菜单)</label>
            <select class="form-control" name="pid">
                <option name="pid" value="0" selected>顶级菜单</option>
                @foreach($rows as $row)
                    @if($row->pid==0)
                        <option name="pid" value="{{ $row->id }}">{{ $row->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>地址路由(URL,顶级可不填)</label>
            <input type="text" name="url" class="form-control" value="{{ old('url') }}">
        </div>
        <div>
            <p><label>权限:</label></p>
            @foreach($data as $row)
                <input type="radio" name="permission_id" value="{{$row->id }}"/>{{ $row->name }}
            @endforeach
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
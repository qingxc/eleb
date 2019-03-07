@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加角色</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('rbacjs.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>角色名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div>
            <p><label>权限:</label></p>
            @foreach($rows as $row)
                <input type="checkbox" name="permission[]" value="{{$row->name }}"/>{{ $row->name }}
            @endforeach
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
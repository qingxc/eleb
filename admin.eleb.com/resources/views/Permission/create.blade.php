@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加权限</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('permission.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>权限名(路由)</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
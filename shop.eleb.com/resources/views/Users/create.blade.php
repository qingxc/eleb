@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>商家注册</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" class="form-control" name="email">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
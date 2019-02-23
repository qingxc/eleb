@extends('layout.app')
@section('content')
    @include('layout._tips')
    @include('layout._errors')
    <form action="{{route('login')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" name="name" class="form-control" value="" id="exampleInputEmail1" placeholder="请输入用户名">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="请输入密码">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" value="1"> 记住登录状态
            </label>
        </div>

        {{csrf_field()}}
        <button type="submit" class="btn btn-default btn-primary">登录</button>
    </form>
@stop();
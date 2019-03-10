@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('admins.update',[$admin])}}" method="post" >
        <div class="form-group">
            <label for="exampleInputEmail1">管理员名称</label>
            <input type="text" name="name" class="form-control" value="{{
            old('name')??$admin->name }}" id="exampleInputEmail1" placeholder="管理员名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">旧密码</label>
            <input type="password" name="oldpassword" class="form-control" value="{{
            old('age') }}" id="exampleInputEmail1" placeholder="管理员旧密码">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">新密码</label>
            <input type="password" name="password" class="form-control" value="{{
            old('age') }}" id="exampleInputEmail1" placeholder="管理员新密码">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" class="form-control" name="email" value="{{
            old('email')??$admin->email }}" placeholder="管理员邮箱">
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改用户</button>
    </form>
@stop();
@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('users.update',[$user])}}" method="post" >
        <div class="form-group">
            <label for="exampleInputEmail1">商家名称</label>
            <input type="text" name="name" class="form-control" value="{{
            old('name')??$user->name }}" id="exampleInputEmail1" placeholder="商家名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">旧密码</label>
            <input type="password" name="oldpassword" class="form-control" value="{{
            old('age') }}" id="exampleInputEmail1" placeholder="旧密码">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">新密码</label>
            <input type="password" name="password" class="form-control" value="{{
            old('age') }}" id="exampleInputEmail1" placeholder="新密码">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" class="form-control" name="email" value="{{
            old('email')??$user->email }}" placeholder="邮箱">
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改用户</button>
    </form>
@stop();
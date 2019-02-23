@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('users.update',[$user])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //echo $users;exit;?>
        <h1>账号修改:</h1>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')??$user->name }}">
        </div>
        <div class="form-group">
            <label>邮箱:</label>
            <input type="text" name="email" class="form-control" value="{{ old('email')??$user->email }}">
        </div>
        <div class="form-group">
            <label>所属商家:</label>
            <select class="form-control" name="shop_id">
                @foreach($shops as $shop)
                    <option value="{{$shop->id}}" @if($user->shop_id == $shop->id ) selected @endif>{{$shop->shop_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>密码:</label>
            <input type="password" name="password" class="form-control" value="{{ old('password')??$user->password }}">
        </div>
        <div class="form-group">
            <label>状态:</label>
            <input   type="radio"   value='1'     name="statues"   checked="checked"/>启用
            <input   type="radio"   value='0'     name="statues"   />禁用
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
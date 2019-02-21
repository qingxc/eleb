@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('shopcategory.update',[$shopcategory])}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">管理员名称</label>
            <input type="text" name="name" class="form-control" value="{{
            old('name')??$shopcategory->name }}" id="exampleInputEmail1" placeholder="管理员名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">状态</label>
            <input type="text" name="status" class="form-control" value="{{
            old('age')??$shopcategory->status }}" id="exampleInputEmail1" placeholder="管理员密码">
        </div>
        <div class="form-group">
            <label>头像上传</label>
            <input type="file" name="img">
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改分类</button>
    </form>
@stop();
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
        <div id="uploader-demo">
            <!--用来存放item-->
            <label>图片上传:</label>
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" >选择图片</div>
            <img src="" id="img1" style="width: 80px"/>
            <input name="shop_img" type="hidden" value="" id="img_path"/>
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改分类</button>
    </form>
@stop();
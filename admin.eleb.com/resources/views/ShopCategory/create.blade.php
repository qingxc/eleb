@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('shopcategory.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>分类名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>状态</label>
            <input   type="radio"   value="1"  class=""   name="status"   checked="checked"/>显示
            <input   type="radio"   value="0"    name="status"   >隐藏
        </div>
        <div id="uploader-demo">
            <!--用来存放item-->
            <label>图片上传:</label>
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" >选择图片</div>
            <img src="" id="img1" style="width: 80px"/>
            <input name="shop_img" type="hidden" value="" id="img_path"/>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
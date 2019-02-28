@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加菜品</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('menus.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ old('goods_name') }}">
        </div>
        <div class="form-group">
            <label>评分</label>
            <input type="text" name="rating" class="form-control" value="{{ old('rating') }}">
        </div>
        <div class="form-group">
            <label>所属分类ID</label>
            <select class="form-control" name="category_id">
                @foreach($rows as $row)
                    <option value="{{ $row->id }}"
                            @if(old('category_id')==$row->id) selected @endif
                    >{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格</label>
            <input type="text" name="goods_price" class="form-control" value="{{ old('goods_price') }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{ old('tips') }}">
        </div>
        <div id="uploader-demo">
            <!--用来存放item-->
            <label>图片上传:</label>
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" >选择图片</div>
            <img src="" id="img1" style="width: 80px"/>
        </div>
        <div class="form-group">
            <label>状态</label>
            <input type="radio" name="status"  value=0>下架
            <input type="radio" name="status"  value=1 checked="checked">上架

        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
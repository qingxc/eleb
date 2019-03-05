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
        <div class="form-group">
            <label>图片</label>
            <input type="file" name="img">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
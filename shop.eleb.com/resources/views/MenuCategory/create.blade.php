@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加菜品分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('menucategory.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>菜品编号（a-z前端使用）</label>
            <input type="text" name="type_accumulation" class="form-control" value="{{ old('type_accumulation') }}">
        </div>
        <div class="form-group">
            <label>所属商家ID</label>
            <input type="text" name="shop_id" class="form-control" value="{{ old('shop_id') }}">
        </div>
        <div class="form-group">
            <label>	描述</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label>是否是默认分类</label>
            <input type="radio" name="is_selected"  value=0>不添加
            <input type="radio" name="is_selected"  value=1>添加

        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
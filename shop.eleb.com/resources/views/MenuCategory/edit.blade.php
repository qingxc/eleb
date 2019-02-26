@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('menucategory.update',[$menucategory])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //var_dump($menucategor);exit;?>
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" name="name" class="form-control" value="{{
            old('name')??$menucategory->name }}" id="exampleInputEmail1" placeholder="名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">菜品编号</label>
            <input type="text" name="type_accumulation" class="form-control" value="{{
            old('type_accumulation')??$menucategory->type_accumulation }}" id="exampleInputEmail1" placeholder="菜品编号">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">所属商家ID</label>
            <input type="text" name="shop_id" class="form-control" value="{{
            old('shop_id')??$menucategory->shop_id }}" id="exampleInputEmail1" placeholder="所属商家ID">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">	描述</label>
            <input type="text" name="description" class="form-control" value="{{
            old('description')??$menucategory->description	 }}" id="exampleInputEmail1" placeholder="描述">
        </div>
        <div class="form-group">
            <label>是否是默认分类</label>
            <input type="radio" name="is_selected"  value=0 checked="checked">不添加
            <input type="radio" name="is_selected"  value=1>添加
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
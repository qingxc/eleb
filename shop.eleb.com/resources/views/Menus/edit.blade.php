@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('menus.update',[$menu])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //var_dump($menucategor);exit;?>
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{
            old('goods_name')??$menu->goods_name }}" id="exampleInputEmail1" placeholder="名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">评分</label>
            <input type="text" name="type_accumulation" class="form-control" value="{{
            old('rating')??$menu->rating }}" id="exampleInputEmail1" placeholder="评分">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">所属分类</label>
            <select class="form-control" name="category_id">
                @foreach($rows as $row)
                    <option value="{{ $row->id }}"
                            @if(old('category_id')==$row->id) selected @endif
                    >{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">	价格</label>
            <input type="text" name="goods_price" class="form-control" value="{{
            old('goods_price')??$menu->goods_price	 }}" id="exampleInputEmail1" placeholder="价格">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">	提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{
            old('tips')??$menu->tips	 }}" id="exampleInputEmail1" placeholder="提示信息">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">	图片</label>
            <input type="file" name="goods_img" class="form-control" value="{{
            old('goods_img')??$menu->goods_img	 }}" id="exampleInputEmail1" placeholder="价格">
        </div>
        <div class="form-group">
            <label>状态</label>
            <input type="radio" name="is_selected"  value=0 >下架
            <input type="radio" name="is_selected"  value=1 checked="checked">上架
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
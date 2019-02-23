@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('shops.update',[$shop])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //echo $users;exit;?>
        <h1>店铺信息修改:</h1>
        {{--<div class="form-group">--}}
            {{--<label>名称:</label>--}}
            {{--<input type="text" name="name" class="form-control" value="{{ old('name')??$shop->name }}">--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label>店铺分类:</label>--}}
            {{--<select name="shop_category_id" class="form-control">--}}
                {{--@foreach($shopcategory as $shopcategory2)--}}
                    {{--<option value="{{ $shopcategory2->id }}"--}}
                            {{--@if(old('shop_category_id')==$shopcategory2->id) selected @endif--}}
                    {{-->{{ $shopcategory2->name }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        <div class="form-group">
            <label>店铺id:</label>
            <input type="text" name="shop_category_id" class="form-control" value="{{ old('shop_name')??$shop->shop_category_id }}">
        </div>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name')??$shop->shop_name }}">
        </div>
        <div class="form-group">
            <label>	店铺图片:</label>
            <input type="file" name="shop_img" class="form-control-file" value="{{ old('shop_img') }}">
        </div>
        <div class="form-group">
            <label>评分:</label>
            <input type="text" name="shop_rating" class="form-control" value="{{ old('shop_rating')??$shop->shop_rating }}">
        </div>
        <div class="form-group">
            <label>是否是品牌:</label>
            <input   type="radio"   value=1    name="brand"   checked="checked"/>是
            <input   type="radio"   value=0    name="brand"   >否
        </div>
        <div class="form-group">
            <label>是否准时送达:</label>
            <input   type="radio"   value=1   name="on_time"   checked="checked"/>是
            <input   type="radio"   value=0    name="on_time"   >否
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送:</label>
            <input   type="radio"   value=1    name="fengniao"   checked="checked"/>是
            <input   type="radio"   value=0    name="fengniao"   >否
        </div>
        <div class="form-group">
            <label>是否保标记:</label>
            <input   type="radio"   value=1    name="bao"   checked="checked"/>是
            <input   type="radio"   value=0    name="bao"   >否
        </div>
        <div class="form-group">
            <label>是否票标记:</label>
            <input   type="radio"   value=1    name="piao"   checked="checked"/>是
            <input   type="radio"   value=0    name="piao"   >否
        </div>
        <div class="form-group">
            <label>是否准标记:</label>
            <input   type="radio"   value=1    name="zhun"   checked="checked"/>是
            <input   type="radio"   value=0    name="zhun"   >否
        </div>
        <div class="form-group">
            <label>起送金额:</label>
            <input type="text" name="start_send" class="form-control" value="{{ old('start_send')??$shop->start_send }}">
        </div>
        <div class="form-group">
            <label>配送费:</label>
            <input type="text" name="send_cost" class="form-control" value="{{ old('send_cost')??$shop->send_cost }}">
        </div>
        <div class="form-group">
            <label>店公告:</label>
            <input type="text" name="notice" class="form-control" value="{{ old('notice')??$shop->notice }}">
        </div>
        <div class="form-group">
            <label>优惠信息:</label>
            <input type="text" name="discount" class="form-control" value="{{ old('discount')??$shop->discount }}">
        </div>
        <div class="form-group">
            <label>	状态:</label>
            <input   type="radio"   value=1    name="status"   checked="checked"/>正常
            <input   type="radio"   value=0    name="status"   >待审核
            <input   type="radio"   value=-1    name="status"   >禁用
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
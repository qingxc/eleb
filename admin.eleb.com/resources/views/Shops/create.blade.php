@extends('./layout/app')
@section('content')
    @include('layout._tips')
    @include('layout._errors')
    <form method="post" action="{{ route('shops.store') }}" enctype="multipart/form-data">
        <h1>店铺注册:</h1>
        <div class="form-group">
            <label>店铺分类:</label>
            <select name="shop_category_id" class="form-control">
                @foreach($shopcategory as $shopcategory2)
                    <option value="{{ $shopcategory2->id }}"
                            @if(old('shop_category_id')==$shopcategory2->id) selected @endif
                    >{{ $shopcategory2->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
        </div>


        <div id="uploader-demo">
            <!--用来存放item-->
            <label>图片上传:</label>
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" >选择图片</div>
            <img src="" id="img1" style="width: 80px"/>
            <input name="shop_img" type="hidden" value="" id="img_path"/>
        </div>



        <div class="form-group">
            <label>评分:</label>
            <input type="text" name="shop_rating" class="form-control" value="{{ old('shop_rating') }}">
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
            <input type="text" name="start_send" class="form-control" value="{{ old('start_send') }}">
        </div>
        <div class="form-group">
            <label>配送费:</label>
            <input type="text" name="send_cost" class="form-control" value="{{ old('send_cost') }}">
        </div>
        <div class="form-group">
            <label>店公告:</label>
            <input type="text" name="notice" class="form-control" value="{{ old('notice') }}">
        </div>
        <div class="form-group">
            <label>优惠信息:</label>
            <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
        </div>
        <div class="form-group">
            <label>	状态:</label>
            <input   type="radio"   value=1    name="status"   checked="checked"/>正常
            <input   type="radio"   value=0    name="status"   >待审核
            <input   type="radio"   value=-1    name="status"   >禁用
        </div>


        <h1>账号注册:</h1>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>邮箱:</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>密码:</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>状态:</label>
            <input   type="radio"   value=1  class=""   name="statues"   />启用
            <input   type="radio"   value=0    name="statues"   checked="checked">禁用
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>

    </form>
    {{--@include('layout._foot')--}}
@stop
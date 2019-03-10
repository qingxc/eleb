@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('events.update',[$event])}}" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" name="title" class="form-control" value="{{
            old('title')??$event->title }}" id="exampleInputEmail1" placeholder="名称">
        </div>

        <div class="form-group">
            <label>活动详情</label>
            <script id="container" class="reply_ueditor" name="content" type="text/plain">{!!$event->content!!}</script>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">报名开始时间</label>
            <input type="text" name="signup_start" class="form-control" value="{{
            old('signup_start')??$event->signup_start }}" id="exampleInputEmail1" placeholder="报名开始时间">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">报名结束时间</label>
            <input type="text" name="signup_end" class="form-control" value="{{
            old('signup_end')??$event->signup_end }}" id="exampleInputEmail1" placeholder="报名结束时间">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">开奖日期</label>
            <input type="datetime-local" name="prize_date" class="form-control" value="{{
            old('prize_date')??str_replace(' ','T',$event->prize_date) }}" id="exampleInputEmail1">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">报名人数限制</label>
            <input type="text" name="signup_num" class="form-control" value="{{
            old('signup_num')??$event->signup_num }}" id="exampleInputEmail1" placeholder="报名人数限制">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否已开奖</label>
            <input type="radio" name="is_prize" value="0" <?php if($event->is_prize==0) echo 'checked' ?>/>未开奖
            <input type="radio" name="is_prize" value="1" <?php if($event->is_prize==1) echo 'checked' ?>/>已开奖
        </div>

        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改分类</button>
    </form>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <script>
        // 实例化编辑器
        var ue = UE.getEditor('container');
    </script>
@stop();
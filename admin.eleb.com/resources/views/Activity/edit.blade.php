@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('activity.update',[$activity])}}" method="post" >
        <div class="form-group">
            <label for="exampleInputEmail1">活动名称</label>
            <input type="text" name="title" class="form-control" value="{{
            old('title')??$activity->title }}" id="exampleInputEmail1" placeholder="活动名称">
        </div>

        <div class="form-group">
            <label>活动详情</label>
            <script id="container" class="reply_ueditor" name="content" type="text/plain">{!!$activity->content!!}</script>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">活动开始时间</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{
            old('start_time')??$activity->start_time }}" id="exampleInputEmail1" placeholder="活动名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">活动结束时间</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{
            old('end_time')??$activity->end_time }}" id="exampleInputEmail1" placeholder="活动名称">
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
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
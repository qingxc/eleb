@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加活动</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('activity.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>活动标题</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>活动详情</label>

            <script id="container" class="reply_ueditor" name="content" type="text/plain"></script>
        </div>
        <div class="form-group">
            <label>	活动开始时间格式是<?php echo date('Y-m-d H:i:s');?></label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time') }}">
        </div>
        <div class="form-group">
            <label>活动结束时间</label>
            <input type="datetime-local" class="form-control" name="end_time" value="{{ old('end_time') }}">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>

    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <script>
        // 实例化编辑器
        var ue = UE.getEditor('container');
    </script>
@stop
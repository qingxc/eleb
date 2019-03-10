@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>添加抽奖活动</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('events.store') }}" enctype="multipart/form-data">

        <div class="form-group">
            <label>名称</label>
            <input type="text" name="title" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>活动详情</label>
            <script id="container" class="reply_ueditor" name="content" type="text/plain"></script>
        </div>

        <div class="form-group">
            <label>报名开始时间</label>
            <input type="text" name="signup_start" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>报名结束时间</label>
            <input type="text" name="signup_end" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>开奖日期</label>
            <input type="datetime-local" name="prize_date" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>报名人数限制</label>
            <input type="text" name="signup_num" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>是否已开奖</label>
            <input type="radio" name="is_prize" value="0"/>未开奖
            <input type="radio" name="is_prize" value="1"/>已开奖
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
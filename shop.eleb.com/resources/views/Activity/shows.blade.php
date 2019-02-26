@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <form action="{{route('activity.index')}}">
    <div class="form-group">
        <div class="input-group">
            <select class="form-control" name="status">
                <option value="0"selected="selected">全部</option>
                <option value="1">未开始</option>
                <option value="2">进行中</option>
                <option value="3">已结束</option>
            </select>
            <button type="submit" class="btn btn-default btn-primary">查看</button>
        </div>
    </div>
    </form>
    <h1>正在进行的活动</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activity as $activit)
            <tr>
                <td>{{ $activit->id }}</td>
                <td>{{ $activit->title }}</td>
                <td>{{ $activit->start_time }}</td>
                <td>{{ $activit->end_time }}</td>
                <td><a href="{{ route('activity.show',[$activit]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('activity.edit',[$activit]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('activity.destroy',[$activit]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
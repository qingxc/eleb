@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动详情</th>
            <th>活动结束时间</th>
        </tr>
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{!!$activity->content!!}</td>
                <td>{{ $activity->end_time }}</td>
            </tr>

    </table>
@stop
@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>参与人数</th>
            <th>最多参与人数</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{!!  $event->content  !!}</td>
                <td>{{ $event->signup_start }}</td>
                <td>{{ $event->signup_end }}</td>
                <td>{{ $event->prize_date }}</td>
                <td>{{ $event->num }}</td>
                <td>{{ $event->signup_num }}</td>
                <td>{{ $event->is_prize==1?'已开奖':'未开奖' }}</td>
                <td>
                    <a href="{{ route('events.show',[$event]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('events.edit',[$event]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('events.destroy',[$event]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                    <a href="{{ route('events.show',[$event]) }}" class="btn btn-warning">开奖</a>
                </td>
            </tr>
        @endforeach
    </table>
@stop
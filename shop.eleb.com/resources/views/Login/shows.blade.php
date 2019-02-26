@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>正在进行的活动</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>详情</th>
        </tr>
        @foreach($activity as $activit)
            <tr>
                <td>{{ $activit->id }}</td>
                <td>{{ $activit->title }}</td>
                <td>{{ $activit->start_time }}</td>
                <td>{{ $activit->end_time }}</td>
                <td><a href="{{ route('login.shows',[$activit]) }}" class="btn btn-info">查看</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
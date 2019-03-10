@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名</th>
            <th>商家</th>
        </tr>
        @foreach($eventmembers as $eventmember)
            <tr>
                <td>{{ $eventmember->id }}</td>
                <td>{{ $eventmember->events_id }}</td>
                <td>{{ $eventmember->member_id }}</td>
            </tr>
        @endforeach
    </table>
@stop
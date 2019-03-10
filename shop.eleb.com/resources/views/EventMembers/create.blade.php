@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <h1>参加抽奖</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('eventmembers.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>活动</label>
            <select name="events_id" class="form-control">
                @foreach($events as $event)
                    <option name="events_id" value="{{ $event->id }}">{{$event->title}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>参与活动商家</label>
            <select name="member_id" class="form-control">
                @foreach($shops as $shop)
                    <option name="member_id" value="{{ $shop->id }}">{{$shop->shop_name}}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@stop
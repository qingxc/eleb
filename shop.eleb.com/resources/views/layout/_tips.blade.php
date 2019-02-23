{{--提示语--}}
@foreach(['success','info','warning','danger'] as $status)
@if(session()->has($status))
<div class="alert alert-{{$status}}" role="alert">{{session($status)}}</div>
@endif
@endforeach
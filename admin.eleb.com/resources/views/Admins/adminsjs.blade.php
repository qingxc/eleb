@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('adminjsg',[$admin])}}" method="post" >
        <div>
            <p><label>角色:</label></p>
            @foreach($rows as $row)
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" name="role[]" value="{{$row->name}}"
                           @if($admin->hasRole($row->name))
                           checked
                            @endif
                    >{{$row->name}}
                </label>
            @endforeach
        </div>
        {{csrf_field()}}
        {{--{{ method_field('patch') }}--}}
        <button type="submit" class="btn btn-default btn-primary">修改角色</button>
    </form>
@stop();
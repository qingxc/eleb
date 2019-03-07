@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('rbacjs.update',[$rbacj])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //echo $users;exit;?>
        <h1>账号修改:</h1>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')??$rbacj->name }}">
        </div>
        <div>
            <p><label>权限:</label></p>
            @foreach($rows as $row)
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" name="role[]" value="{{$row->name}}"
                           @if($rbacj->hasPermissionto($row->name))
                           checked
                            @endif> {{$row->name}}
                </label>
            @endforeach
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
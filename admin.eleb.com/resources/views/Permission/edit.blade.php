@extends('layout.app')
@section('content')
    @include('layout._errors')
    <form action="{{route('permission.update',[$permission])}}" method="post" enctype="multipart/form-data">
<!--        --><?php //echo $users;exit;?>
        <h1>权限修改:</h1>
        <div class="form-group">
            <label>名称:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')??$permission->name }}">
        </div>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-default btn-primary">修改</button>
    </form>
@stop();
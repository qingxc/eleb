@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <form method="post" action="{{ route('members.store') }}">
        <div class="form-group">
            <label>搜索会员</label>
            <input type="text" name="like" class="form-control" value="{{ old('like') }}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">查询</button>
        </div>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>会员名</th>
            <th>联系方式</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>{{ $member->status?'启用':'禁用' }}</td>
                <td><a href="{{ route('members.edit',[$member]) }}" class="btn btn-warning">禁用或启用</a></td>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@stop
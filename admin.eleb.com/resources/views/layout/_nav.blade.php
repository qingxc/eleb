<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">eleb</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家账号 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('users.index')}}">商家列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家管理  <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('shops.index')}}">商家列表</a></li>--}}
                        {{--<li><a href="{{route('shops.create')}}">商家注册</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{route('shopcategory.index')}}">分类列表</a></li>--}}
                        {{--<li><a href="{{route('shopcategory.create')}}">添加分类</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                @if(!empty(auth()->user()))
                    @foreach(\App\Models\Navs::navData() as $row)
                        @if(auth()->user()->hasAnyPermission($row->permission_id))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $row->name }}<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach(\App\Models\Navs::navDataz() as $v)
                                        @if($row->id == $v->pid)
                                            <li><a href="{{route($v->url)}}">{{ $v->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endif
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('activity.index')}}">活动列表</a></li>--}}
                        {{--<li><a href="{{route('activity.create')}}">添加列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('members.index')}}">会员列表</a></li>--}}
                        {{--<li><a href="{{route('members.create')}}">添加会员</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">抽奖管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('events.index')}}">抽奖活动列表</a></li>
                        <li><a href="{{route('events.create')}}">添加抽奖活动</a></li>
                        <li><a href="{{route('eventmembers.index')}}">抽奖报名表</a></li>
                    </ul>
                </li>
            {{--</ul>--}}


            {{--搜索--}}
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('login')}}">登录</a></li>
                <li><a href="{{route('logout')}}">注销</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RBAC <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('rbacjs.index')}}">角色列表</a></li>
                        <li><a href="{{route('rbacjs.create')}}">添加角色</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('permission.index')}}">权限列表</a></li>
                        <li><a href="{{route('permission.create')}}">添加权限</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
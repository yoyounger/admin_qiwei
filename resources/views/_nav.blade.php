<!--导航条-->
<nav class="navbar  navbar-inverse" >
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">当味小外</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href=""><span class="glyphicon glyphicon-tree-conifer"></span>&emsp;首页 <span
                                class="sr-only">(current)</span></a></li>
                <li><a href="{{route('admins.index')}}"><span class="glyphicon glyphicon-education"></span>&emsp;管理员列表</a></li>
                {{--@role('终极超级管理员所有权限')--}}

                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle list-group-item" data-toggle="dropdown" role="button" aria-haspopup="true"--}}
                           {{--aria-expanded="false"><span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="{{route('permissions.index')}}">权限列表</a></li>--}}
                            {{--<li><a href="{{route('roles.index')}}">角色管理</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}

                {{--@endrole--}}

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}"><span class="glyphicon glyphicon-user"></span>&emsp;登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">欢迎您  ! {{auth()->user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-paperclip"></span>&emsp;个人中心</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-erase"></span>&emsp;修改资料</a></li>
                        <li><a href="{{route('reset')}}"><span class="glyphicon glyphicon-scissors"></span>&emsp;修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                <button class="btn btn-link"><span class="glyphicon glyphicon-off"></span>&emsp;安全退出</button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--导航条-->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

@include('_nav')
{{--模态框--}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">管理员登录</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('login')}}" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="管理员名" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="密码" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="captcha" class="form-control" name="captcha" placeholder="验证码">
                        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <button class="btn btn-info form-control">登录</button>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> 记住我
                        </label>
                    </div>
                    {{csrf_field()}}
                </form>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



<div class="row container-fluid" >
    <div class="list-group col-xs-2">
        <a href="{{route('shops.index')}}" class="list-group-item active">入驻商家管理</a>
        <a href="{{route('users.index')}}" class="list-group-item">商家账户管理</a>
        <a href="{{route('shopcategories.index')}}" class="list-group-item">商家分类管理</a>
        <a href="{{route('admins.index')}}" class="list-group-item">管理员列表</a>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-8">
        @include('_messages')
        @yield('contents')
    </div>

</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/js/jquery-3.2.1.js"></script>

<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/js/bootstrap.min.js"></script>
@include('_footer')
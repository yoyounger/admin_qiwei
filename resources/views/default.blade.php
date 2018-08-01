<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>当味小外--平台端</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    @yield('css_files')
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>-->
    <!--[endif]-->

    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="/js/jquery-3.2.1.js"></script>

    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="/js/bootstrap.min.js"></script>

    @yield('js_files')
</head>
<body>

@include('_nav')




<div class="row container-fluid" >
    <div class="list-group col-xs-2">
        <a href="{{route('shops.index')}}" class="list-group-item active">入驻商家管理</a>
        <a href="{{route('users.index')}}" class="list-group-item">商家账户管理</a>
        <a href="{{route('shopcategories.index')}}" class="list-group-item">商家分类管理</a>
        <a href="{{route('admins.index')}}" class="list-group-item">管理员列表</a>
        <a href="{{route('activities.index')}}" class="list-group-item">活动管理</a>
        <a href="{{route('CountOrder')}}" class="list-group-item">商家订单量统计</a>
        <a href="{{route('CountMenu')}}" class="list-group-item">商家菜品销量统计</a>
        <a href="{{route('customers.index')}}" class="list-group-item">平台会员管理</a>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-8">
        @include('_messages')
        @yield('contents')
    </div>

</div>

@yield('js')
@include('_footer')
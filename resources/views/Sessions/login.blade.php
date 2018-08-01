@extends('default')
@section('contents')
    <h1>管理员登录</h1>
    @include('_errors')
    <br>
    <br>
    <br>
    <form action="{{route('login')}}" method="post">
        <div class="form-group">
            <label for="">管理员名</label>
            <input type="text" placeholder="管理员名" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">密码</label>
            <input type="password" placeholder="密码" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="">验证码</label>
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
@stop
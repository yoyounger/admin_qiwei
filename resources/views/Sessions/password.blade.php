@extends('default')
@section('contents')
    <h1>修改个人密码</h1>
    <br>
    <br>
    <br>
    @include('_errors')
    <form action="{{route('password')}}" method="post">
        <div class="form-group">
            <label for="">原密码</label>
            <input type="password" name="oldpassword" placeholder="原密码" class="form-control" value="{{old('oldpassword')}}">
        </div>
        <div class="form-group">
            <label for="">新密码</label>
            <input type="password" name="newpassword" placeholder="新密码" class="form-control" value="{{old('newpassword')}}">
        </div>
        <div class="form-group">
            <label for="">确认新密码</label>
            <input type="password" name="repassword" placeholder="确认新密码" class="form-control">
        </div>
        {{csrf_field()}}
        <button class="btn btn-info btn-block">修改</button>
    </form>
@stop
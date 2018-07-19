@extends('default')
@section('contents')
    <h2>添加管理员</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>管理员</td>
                <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="text" name="email" class="form-control" value="{{old('email')}}"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password" class="form-control" value="{{old('password')}}"></td>
            </tr>
            <tr>
                <td>确认密码</td>
                <td><input type="password" name="repassword" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop
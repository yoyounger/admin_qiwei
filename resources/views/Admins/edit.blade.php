@extends('default')
@section('contents')
    <h2>修改管理员</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('admins.update',[$admin])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>管理员</td>
                <td><input type="text" name="name" class="form-control" value="{{$admin->name}}"></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="text" name="email" class="form-control" value="{{$admin->email}}"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">保存</button></td>
            </tr>
            {{csrf_field()}}
            {{method_field('PATCH')}}
        </table>
    </form>
    @stop
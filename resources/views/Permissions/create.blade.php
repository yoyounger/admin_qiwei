@extends('default')
@section('contents')
    <h2>添加权限</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>权限名称</td>
                <td>
                    <div class="from-group">
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="请输入">
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop
@extends('default')
@section('contents')
    <h2>修改角色</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('roles.update',[$role])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>角色名称</td>
                <td>
                    <div class="from-group">
                        <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="请输入">
                    </div>
                </td>
            </tr>
            <tr>
                <td>角色权限</td>
                <td>
                        @foreach($permissions as $permission)
                            <label><input type="checkbox" value="{{$permission->name}}" name="permissions[]" @if($role->hasPermissionTo($permission)) checked @endif>
                                {{$permission->name}}</label>
                        @endforeach
                </td>
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
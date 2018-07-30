@extends('default')
@section('contents')

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
                    {{$permission->name}}
                    @endforeach
                </td>
            </tr>

        </table>
    @stop
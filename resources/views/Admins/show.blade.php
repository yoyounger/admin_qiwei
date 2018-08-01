@extends('default')
@section('contents')
<h2>权限信息</h2>
        <table class="table table-bordered">
            <tr>
                <td>管理员名</td>
                <td>
                       {{$admin->name}}
                </td>
            </tr>
            <tr>
                <td>角色名</td>
                <td>
                    @foreach($roles as $role)
                        {{$role}} |
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>角色权限</td>
                <td>
                    @foreach($permissions as $permission)
                    {{$permission->name}} |
                    @endforeach
                </td>
            </tr>

        </table>
    @stop
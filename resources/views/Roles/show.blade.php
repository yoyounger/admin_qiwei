@extends('default')
@section('contents')
<h2>角色信息</h2>
        <table class="table table-bordered">
            <tr>
                <td>角色名称</td>
                <td>
                       {{$role->name}}
                </td>
            </tr>
            <tr>
                <td>角色权限</td>
                <td>
                    @foreach($permissions as $permission)
                        @if($role->hasPermissionTo($permission))
                            {{$permission->name}} |
                        @endif
                    @endforeach
                </td>
            </tr>

        </table>
    @stop
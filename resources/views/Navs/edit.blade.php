@extends('default')
@section('contents')
    <h2>修改菜单</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('navs.update',[$nav])}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>菜单名</td>
                <td><input type="text" name="name" class="form-control" value="{{$nav->name}}"></td>
            </tr>
            <tr>
                <td>链接地址</td>
                <td><input type="text" name="url" class="form-control" value="{{$nav->url}}"></td>
            </tr>
            <tr>
                <td>所属菜单</td>
                <td>
                    <select name="pid" class="form-control">
                        <option value="0">顶层菜单</option>
                        @foreach($navs as $value)
                            <option value="{{$value->id}}" @if($nav->id == $value->id) selected @endif>
                                {{$value->name}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>关联权限</td>
                <td>
                    <select name="permission_id" class="form-control">
                        <option value="0">请选择</option>
                        @foreach($permissions as $permission)
                            <option value="{{$permission->id}}" @if($nav->permission_id == $permission->id) selected @endif>
                                {{$permission->name}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">保存</button></td>
            </tr>
            {{method_field('PATCH')}}
            {{csrf_field()}}
        </table>
    </form>
    @stop
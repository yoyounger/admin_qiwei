@extends('default')
@section('contents')
    <h2>添加菜单</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('navs.store')}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>菜单名</td>
                <td><input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="NAME"></td>
            </tr>

            <tr>
                <td>链接地址</td>
                <td><input type="text" name="url" class="form-control" value="{{old('url')}}" placeholder="URL"></td>
            </tr>
            <tr>
                <td>所属菜单</td>
                <td>
                    <select name="pid" class="form-control">
                        <option value="0">顶层菜单</option>
                        @foreach($navs as $nav)

                            <option value="{{$nav->id}}">
                                {{$nav->name}}
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
                            <option value="{{$permission->id}}">
                                {{$permission->name}}
                            </option>
                        @endforeach
                    </select>
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
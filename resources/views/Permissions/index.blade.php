@extends('default')
@section('contents')
    <h2>权限列表</h2>
@role('终极超级管理员所有权限')
     <a class="btn btn-primary" href="{{route('permissions.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加权限</a>
@endrole
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">权限ID</th>
            <th style="text-align: center">权限名称</th>
            @role('终极超级管理员所有权限')
            <th width="30%" style="text-align: center">操作</th>
            @endrole
        </tr>
        @foreach($permissions as $permission)
        <tr>
            <td>{{$permission->id}}</td>
            <td>{{$permission->name}}</td>
            @role('终极超级管理员所有权限')
            <td style="padding-left: 80px">
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('permissions.edit',[$permission])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-2">
                        <form action="{{route('permissions.destroy',[$permission])}}" method="post">
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </div>
                </div>
            </td>
            @endrole
        </tr>
            @endforeach
    </table>
    {{$permissions->links()}}
@stop
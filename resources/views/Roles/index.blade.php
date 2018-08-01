@extends('default')
@section('contents')
    <h2>角色列表</h2>

     <a class="btn btn-primary" href="{{route('roles.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加角色</a>

    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">角色ID</th>
            <th style="text-align: center">角色名称</th>
            <th width="30%" style="text-align: center">操作</th>
        </tr>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td style="padding-left: 80px">
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('roles.edit',[$role])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-2">
                        <a href="{{route('roles.show',[$role])}}" class="btn btn-info"><span class="glyphicon glyphicon-leaf"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-2">
                        <form action="{{route('roles.destroy',[$role])}}" method="post">
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </div>
                </div>
            </td>
        </tr>
            @endforeach
    </table>
    {{$roles->links()}}
@stop
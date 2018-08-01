@extends('default')
@section('contents')
    <h2>管理员账户</h2>

    @role('管理员CRUD')
     <a class="btn btn-primary" href="{{route('admins.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加管理员</a>
    @endrole
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">管理员</th>
            <th style="text-align: center">邮箱</th>
            <th width="30%" style="text-align: center">操作</th>
        </tr>
        @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('admins.show',[$admin])}}" class="btn btn-info"><span class="glyphicon glyphicon-leaf"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    @role('管理员CRUD')
                    <div class="col-xs-2">
                        <a href="{{route('admins.edit',[$admin])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>

                    <div class="col-xs-2">
                        <form action="{{route('admins.destroy',[$admin])}}" method="post">
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </div>
                    @endrole
                </div>
            </td>
        </tr>
            @endforeach
    </table>
    {{$admins->links()}}
@stop
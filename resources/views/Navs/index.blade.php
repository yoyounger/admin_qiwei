@extends('default')
@section('contents')
    <h2>导航菜单</h2>

    @role('管理导航菜单')
     <a class="btn btn-primary" href="{{route('navs.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加菜单</a>
  @endrole
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">主菜单名称</th>
            <th style="text-align: center">父级菜单名</th>
            <th style="text-align: center">地址</th>
            <th style="text-align: center">关联权限</th>
            @role('管理导航菜单')
            <th width="30%" style="text-align: center">操作</th>
            @endrole
        </tr>
        @foreach($navs as $nav)
        <tr>
            <td>{{$nav->id}}</td>
            <td>{{$nav->name}}</td>
            <td>@if($nav->pid == 0) 顶层菜单 @else{{$nav->nav->name}} @endif</td>
            <td>{{$nav->url}}</td>
            <td>
               {{$nav->permission->name}}
            </td>
            @role('管理导航菜单')
            <td style="padding-left: 80px">
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('navs.edit',[$nav])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-2">
                        <form action="{{route('navs.destroy',[$nav])}}" method="post">
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
    {{$navs->links()}}
@stop
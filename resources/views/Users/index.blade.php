@extends('default')
@section('contents')
    <h2>商家账户</h2>
    <br>
    <br>
    <br>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">账户名称</th>
            <th style="text-align: center">邮箱</th>
            <th style="text-align: center">拥有店铺</th>
            <th style="text-align: center">账户状态</th>
            <th width="30%" style="text-align: center">操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->shop->shop_name}}</td>
                <td>@if($user->status) <span style="color: green">启用</span>@else <span style="color: red">禁用</span> @endif</td>
                <td style="padding-left: 20px">
                    <div class="row">
                        @role('商家账户审核')
                        <div class="col-xs-2">
                    <form action="{{route('no')}}" method="post">
                        <input type="hidden" value="{{$user->status}}" name="status">
                        <input type="hidden" value="{{$user->id}}" name="id">
                        @if($user->status == 0)
                            <button type="submit" class="btn btn-success">审核通过</button>
                        @endif
                        @if($user->status == 1 )
                            <button type="submit" class="btn btn-warning">账户禁用</button>
                        @endif
                        {{csrf_field()}}
                    </form>
                        </div>
                        @endrole
                        <div class="col-xs-2">
                        </div>
                        @role('商家账户部')
                        <div class="col-xs-2">
                            <a href="{{route('set',[$user])}}" class="btn btn-primary">重置密码</a>
                        </div>
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('users.destroy',[$user])}}" method="post">
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
    {{$users->links()}}
@stop
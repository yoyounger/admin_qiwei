@extends('default')
@section('contents')
    <h2>会员列表</h2>
    <br>
    <br>
    <form action="{{route('customers.index')}}" method="get">
                <input type="text"  placeholder="会员名" name="username" style="height: 33px">
                <input type="number"  placeholder="电话号码" name="tel" style="height: 33px">
                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
        {{csrf_field()}}
    </form>
    <br> <br>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">会员名称</th>
            <th style="text-align: center">电话</th>
            <th style="text-align: center">状态</th>
            <th width="30%" style="text-align: center">操作</th>
        </tr>
        @foreach($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->username}}</td>
            <td>{{$customer->tel}}</td>
            <td>@if($customer->status == 0) 禁用 @else 正常 @endif</td>
            <td style="padding-left: 80px">
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('customers.show',[$customer])}}" class="btn btn-info">查看</a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                </div>
            </td>
        </tr>
            @endforeach
    </table>
    {{$customers->appends($data)->links()}}
@stop
@extends('default')
@section('contents')
    <h2>入驻商家管理</h2>
    @role('商家入驻部')
    <a class="btn btn-primary" href="{{route('shops.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加商家</a>
    @endrole
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">店铺名称</th>
            <th style="text-align: center">店铺分类</th>
            <th style="text-align: center">店铺图片</th>
            <th style="text-align: center">品牌否</th>
            <th style="text-align: center">准时达</th>
            <th style="text-align: center">蜂鸟配送</th>
            <th style="text-align: center">商铺状态</th>
            <th style="text-align: center">所属账户</th>
            <th style="text-align: center">操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>{{$shop->shopcatgory->name}}</td>
                <td><img src="{{$shop->shop_img}}" alt="" width="50px"></td>
                <td>@if($shop->brand) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif</td>
                <td>@if($shop->zhun) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif</td>
                <td>@if($shop->fengniao) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif</td>
                <td>@if($shop->status == 1) <span style="color: green">正常</span> @elseif($shop->status==0) <span style="color: midnightblue">审核中</span> @else <span style="color: red">禁用</span> @endif</td>
                <td>{{$shop->user->name}}</td>
                <td>
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="{{route('shops.show',[$shop])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>
                        @role('商家入驻部')
                        <div class="col-xs-2" style="margin-left: 5px">
                            <a href="{{route('shops.edit',[$shop])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                        <div class="col-xs-2" style="margin-left: 5px">
                            <form action="{{route('shops.destroy',[$shop])}}" method="post">
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
    {{$shops->links()}}
@stop
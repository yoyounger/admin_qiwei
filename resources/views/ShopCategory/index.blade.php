@extends('default')
@section('contents')
    <h2>商家分类</h2>

     <a class="btn btn-primary" href="{{route('shopcategories.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加分类</a>

    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">商家分类</th>
            <th style="text-align: center">分类图片</th>
            <th style="text-align: center">状态</th>
            <th width="30%" style="text-align: center">操作</th>
        </tr>
        @foreach($shopcategories as $shopcategory)
        <tr>
            <td>{{$shopcategory->id}}</td>
            <td>{{$shopcategory->name}}</td>
            <td><img src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}" alt="" class="img-circle" width="50px"></td>
            <td>@if($shopcategory->status) 显示@else 隐藏 @endif</td>
            <td style="padding-left: 80px">
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('shopcategories.edit',[$shopcategory])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-2">
                        <form action="{{route('shopcategories.destroy',[$shopcategory])}}" method="post">
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
    {{$shopcategories->links()}}
@stop
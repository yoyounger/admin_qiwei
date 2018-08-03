@extends('default')
@section('contents')
    <h2>抽奖活动奖品列表</h2>
    <h4>当前活动:{{$event->title}}</h4>
    @can('添加奖品')
    @if($event->prize_date > date('Y-m-d',time()))
     <a class="btn btn-primary" href="{{route('eventprizes.create',['events_id'=>$event->id])}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加奖品</a>
     @endif
    @endcan
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">活动名称</th>
            <th style="text-align: center">奖品名称</th>
            <th style="text-align: center">奖品详情</th>
            <th style="text-align: center">中奖账户</th>
            <th style="text-align: center">操作</th>
        </tr>
        @foreach($eventprizes as $eventprize)
        <tr>
            <td>{{$eventprize->id}}</td>
            <td>{{$event->title}}</td>
            <td>{{$eventprize->name}}</td>
            <td>{{$eventprize->description}}</td>
            <td>@if(isset($eventprize->user->name)){{$eventprize->user->name}} @else 尚未开奖 @endif</td>
            <td style="padding-left: 80px">
                @if($event->prize_date > date('Y-m-d',time()))
                <div class="row">
                    @can('修改奖品')
                    <div class="col-xs-2">
                        <a href="{{route('eventprizes.edit',[$eventprize])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    @endcan
                    <div class="col-xs-1">
                    </div>
                        @can('删除奖品')
                    <div class="col-xs-2">
                        <form action="{{route('eventprizes.destroy',[$eventprize])}}" method="post">
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </div>
                        @endcan
                </div>
                @endif
            </td>
        </tr>
            @endforeach
    </table>
    {{$eventprizes->links()}}
@stop
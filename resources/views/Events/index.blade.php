@extends('default')
@section('contents')
    <h2>抽奖活动列表</h2>
    @can('添加抽奖活动')
    <a href="{{route('events.create')}}" class="btn btn-primary" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>添加活动</a>
    @endcan


    <table class="table table-bordered table-hover" style="text-align: center">
        <tr>
            <th style="text-align: center">编号</th>
            <th style="text-align: center">活动名称</th>
            <th style="text-align: center">是否开奖</th>
            <th style="text-align: center">人数</th>
            <th style="text-align: center">开始时间</th>
            <th style="text-align: center">结束时间</th>
            <th style="text-align: center">操作</th>
        </tr>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>
                {{$event->is_prize?'已开奖':'未开奖'}}
            </td>
            <td>{{$event->signup_num}}</td>
            <td>{{date('Y-m-d H:i',$event->signup_start)}}</td>
            <td>{{date('Y-m-d H:i',$event->signup_end)}}</td>
            <td>
                <div class="row">
                    <div class="col-xs-1" style="margin-left: 10px">
                        <a href="{{route('events.show',[$event])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                    </div>
                    @can('修改抽奖活动')
                    <div class="col-xs-1" style="margin-left: 10px">
                        <a href="{{route('events.edit',[$event])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    @endcan
                        @can('删除抽奖活动')
                    <div class="col-xs-1" style="margin-left: 10px">
                        <form action="{{route('events.destroy',[$event])}}" method="post">
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-paste"></span></button>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </div>
                        @endcan
                            @can('查看报名和奖品')
                    <div class="col-xs-1" style="margin-left: 10px">
                        <a href="{{route('eventprizes.index',['events_id'=>$event->id])}}" class="btn btn-info">奖品</a>
                    </div>

                    <div class="col-xs-1" style="margin-left: 20px">
                        <a href="{{route('eventmembers.index',['id'=>$event->id])}}" class="btn btn-success">报名表</a>
                    </div>
                            @endcan
                    <div class="col-xs-1" style="margin-left: 40px">
                        @if($event->is_prize)
                            <button class="btn btn-warning" disabled>已开奖</button>
                        @elseif($event->prize_date>date('Y-m-d',time()))
                            <button class="btn btn-default" disabled>待开奖</button>
                            @can('抽奖')
                        @else
                        <a href="{{route('prize',[$event->id])}}" class="btn btn-primary">开奖</a>
                                @endcan
                            @endif
                    </div>

                </div>
            </td>
        </tr>
            @endforeach
    </table>
@endsection
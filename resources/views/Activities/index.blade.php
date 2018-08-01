@extends('default')
@section('contents')
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <form action="{{route('activities.index')}}" method="get">
                <input type="hidden" value="2" name="act_status">
                <button class="btn btn-link">全部</button>
                {{csrf_field()}}
            </form>
        </li>
        <li role="presentation" class="active">
            <form action="{{route('activities.index')}}" method="get">
                <input type="hidden" value="1" name="act_status">
                <button class="btn btn-link">进行中</button>
                {{csrf_field()}}
            </form>
        </li>
        <li role="presentation" class="active">
            <form action="{{route('activities.index')}}" method="get">
                <input type="hidden" value="0" name="act_status">
                <button class="btn btn-link">未开始</button>
                {{csrf_field()}}
            </form>
        </li>
        <li role="presentation" class="active">
            <form action="{{route('activities.index')}}" method="get">
                <input type="hidden" value="-1" name="act_status">
                <button class="btn btn-link">已结束</button>
                {{csrf_field()}}
            </form>
        </li>
    </ul>
    <br>
    @role('活动部')
    <a href="{{route('activities.create')}}" class="btn btn-primary" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>添加活动</a>
    @endrole
    <table class="table table-bordered table-hover" style="text-align: center">
        <tr>
            <th style="text-align: center">序号</th>
            <th style="text-align: center">活动标题</th>
            <th style="text-align: center">活动状态</th>
            <th style="text-align: center">开始时间</th>
            <th style="text-align: center">结束时间</th>
            <th style="text-align: center">操作</th>
        </tr>
        <?php $i=1?>
        @foreach($activities as $activity)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$activity->title}}</td>
            <td>
                @if($activity->start_time<=date('Y-m-d H:i:s',time()) && $activity->end_time>=date('Y-m-d H:i:s',time())) <span style="color: green">活动进行中</span>@elseif($activity->start_time>date('Y-m-d H:i:s',time())) <span style="color: blue">活动未开始</span>@elseif($activity->end_time<date('Y-m-d H:i:s',time())) <span style="color: red">活动已结束</span> @endif
            </td>
            <td>{{substr($activity->start_time,0,16)}}</td>
            <td>{{substr($activity->end_time,0,16)}}</td>
            <td>
                <div class="row">
                    <div class="col-xs-2">
                        <a href="{{route('activities.show',[$activity])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                    </div>
                    @role('活动部')
                    <div class="col-xs-2">
                        <a href="{{route('activities.edit',[$activity])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                    </div>
                    @endrole
                    @role('活动部老大')
                    <div class="col-xs-2">
                        <form action="{{route('activities.destroy',[$activity])}}">
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-paste"></span></button>
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
    @endsection
@extends('default')
@section('contents')
    <h2>活动详情</h2>
    <br>
    <br>
    <table class="table table-bordered">
        <tr>
            <td width="100px">活动标题</td>
            <td>{{$activity->title}}</td>
        </tr>
        <tr>
            <td>开始时间</td>
            <td>
                {{substr($activity->start_time,0,16)}}
            </td>
        </tr>

        <tr>
            <td>结束时间</td>
            <td>
                {{substr($activity->end_time,0,16)}}
            </td>
        </tr>
        <tr>
            <td>活动内容</td>
            <td>
                {!!$activity->content!!}
            </td>
        </tr>
    </table>
@stop
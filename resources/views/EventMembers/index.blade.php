@extends('default')
@section('contents')
    <h2>抽奖列表</h2>
    <br>
    <br> <br>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">账户名</th>
            <th style="text-align: center">邮箱</th>
        </tr>
        @foreach($eventmembers as $eventmember)
        <tr>
            <td>{{$eventmember->user->id}}</td>
            <td>{{$eventmember->user->name}}</td>
            <td>{{$eventmember->user->email}}</td>
        </tr>
            @endforeach
    </table>
    {{$eventmembers->links()}}
@stop
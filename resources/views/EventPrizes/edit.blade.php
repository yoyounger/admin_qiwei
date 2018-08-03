@extends('default')
@section('contents')
    <h2>修改奖品</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('eventprizes.update',[$eventprize])}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>奖品名称</td>
                <td><input type="text" name="name" class="form-control" value="{{$eventprize->name}}" placeholder="必填"></td>
                {{--<td><input type="hidden" name="events_id" value="{{$events_id}}"></td>--}}
            </tr>
            <tr>
                <td>奖品详情</td>
                <td>
                    <textarea name="description"  class="form-control">{{$eventprize->description}}</textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">保存</button></td>
            </tr>
            {{csrf_field()}}
            {{method_field('PATCH')}}
        </table>
    </form>
@stop
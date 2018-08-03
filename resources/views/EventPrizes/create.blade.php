@extends('default')
@section('contents')
    <h2>添加奖品</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('eventprizes.store')}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>奖品名称</td>
                <td><input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="必填"></td>
                <td><input type="hidden" name="events_id" value="{{$events_id}}"></td>
            </tr>
            <tr>
                <td>奖品详情</td>
                <td>
                    <textarea name="description"  class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop
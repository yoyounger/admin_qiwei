@extends('default')
@section('contents')
    <h2>会员信息详情</h2>
    <br>
    <br>
        <table class="table table-bordered">
            <tr>
                <td>用户名</td>
                <td>{{$customer->username}}</td>
            </tr>
            <tr>
                <td>电话</td>
                <td>
                    {{$customer->tel}}
                </td>
            </tr>
            @foreach($addresses as $address)
            <tr>
                <td>地址</td>
                <td>
                    {{$address->provience.$address->city.$address->county.$address->address}}
                </td>
            </tr>
            @endforeach
            @role('会员管理部')
            <tr>
                <td>操作</td>
                <td><form action="{{route('change')}}" method="get">
                        <input type="hidden" value="{{$customer->status}}" name="status">
                        <input type="hidden" value="{{$customer->id}}" name="id">
                        @if( $customer->status == 0)
                            <button type="submit" class="btn btn-primary">通过</button>
                        @endif
                        @if($customer->status == 1 )
                            <button type="submit" class="btn btn-warning">禁用</button>
                        @endif
                        {{csrf_field()}}
                    </form></td>
            </tr>
            @endrole
        </table>
@stop
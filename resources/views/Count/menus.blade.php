@extends('default')
@section('contents')
<h2>各店铺菜品销量统计</h2>
<br>
<span>今日销量:@if($day_total==null) 0 @else{{$day_total}} @endif</span>
<span style="margin-left:300px">本月销量:{{$month_total}}</span>
<span style="float: right">累计销量:{{$total}}</span>
<br>
<br>
<div class="row">
    <div class="col-lg-4">
        <table class="table table-bordered" style="text-align: center">
            <tr>
                <th colspan="4">今日销量</th>
            </tr>
            <tr>
                <td>序号</td>
                <td>店名称</td>
                <td>销量</td>
            </tr>
            <?php $i=1?>
            @foreach($menu_dayrank as $rank)
                <tr>
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$rank->shop_name}}</td>
                    <td>{{$rank->sum}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-lg-4">
        <table class="table table-bordered" style="text-align: center">
            <tr>
                <th colspan="4">本月销量</th>
            </tr>
            <tr>
                <td>序号</td>
                <td>店名称</td>
                <td>销量</td>
            </tr>
            <?php $i=1?>
            @foreach($menu_monthrank as $rank)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$rank->shop_name}}</td>
                    <td>{{$rank->sum}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-lg-4">
        <table class="table table-bordered" style="text-align: center">
            <tr>
                <th colspan="4">累计销量</th>
            </tr>
            <tr>
                <td>序号</td>
                <td>店名称</td>
                <td>销量</td>
            </tr>
            <?php $i=1?>
            @foreach($menu_totalrank as $rank)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$rank->shop_name}}</td>
                    <td>{{$rank->sum}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<table class="table table-bordered" style="text-align: center">
    <tr>
        <th style="text-align: center"></th>
        <th style="text-align: center">统计操作</th>
        <th style="text-align: center">统计数量</th>
    </tr>
    <tr>
        <td>按具体日期统计</td>
        <td>
            <form action="{{route('CountMenu')}}" method="get">
                <div class="row">
                    <div class="col-xs-10">
                        <input type="date" name="day" style="height: 34px" value="{{$day_date}}" class="form-control">
                    </div>
                    <div class="col-xs-2">
                        <button type="submit" class="btn btn-success">统计</button>
                    </div>
                </div>


        </td>
        <td>@if(!isset($select_daynum )) 0 @else {{$select_daynum}} @endif</td>
    </tr>
    <tr>
        <td>按月份统计</td>
        <td>
            <div class="row">
                <div class="col-xs-10">
                    <input type="month" name="month" style="height: 34px" value="{{$month_date}}" class="form-control">
                </div>
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-success">统计</button>
                </div>
            </div>
        </td>
        <td>@if(!isset($select_monthnum )) 0 @else {{$select_monthnum}} @endif</td>
    </tr>
</table >
<div class="row">
    <div class="col-lg-6">
        <table class="table table-bordered" style="text-align: center">
            <tr>
                <td colspan="3">按某一月统计排行</td>
            </tr>
            <tr>
                <td>序号</td>
                <td>店名称</td>
                <td>销量</td>
            </tr>
            @if(isset($select_monthrank))
            <?php $i=1?>
            @foreach($select_monthrank as $rank)
                <tr>
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$rank->shop_name}}</td>
                    <td>{{$rank->sum}}</td>
                </tr>
            @endforeach
            @endif
        </table>
    </div>
    <div class="col-lg-6">
        <table class="table table-bordered" style="text-align: center">
            <tr>
                <td colspan="3">按某一天统计排行</td>
            </tr>
            <tr>
                <td>序号</td>
                <td>店名称</td>
                <td>销量</td>
            </tr>
            @if(isset($select_dayrank))
            <?php $i=1?>
            @foreach($select_dayrank as $rank)
                <tr>
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$rank->shop_name}}</td>
                    <td>{{$rank->sum}}</td>
                </tr>
            @endforeach
                @endif
        </table>
    </div>
</div>
    @stop
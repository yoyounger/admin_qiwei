@extends('default')
@section('contents')
    <h2>修改抽奖活动</h2>
    @include('_errors')
    <br>
    <br>
    <br>
    <form action="{{route('events.update',[$event])}}" method="post">
        <div class="form-group">
            <label for="">活动名称</label>
            <input type="text" class="form-control" placeholder="必填" name="title" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <label for="">人数限制</label>
            <input type="number" class="form-control" placeholder="必填" name="signup_num" value="{{$event->signup_num}}">
        </div>
        <div class="form-group">
            <label for="">报名开始时间</label>
            <input type="datetime-local" name="signup_start" class="form-control" value="{{date('Y-m-d\TH:i:s',$event->signup_start)}}">
        </div>
        <div class="form-group">
            <label for="">报名结束时间</label>
            <input type="datetime-local" name="signup_end" class="form-control" value="{{date('Y-m-d\TH:i:s',$event->signup_end)}}">
        </div>
        <div class="form-group">
            <label for="">开奖时间</label>
            <input type="date" name="prize_date" class="form-control" value="{{$event->prize_date}}">
        </div>
        <div>
            <label for="">活动详情</label>
            <textarea id="container" name="contents" type="text/plain" style="height: 400px">{{$event->content}}</textarea>
        </div>
        <br>
        <button class="btn btn-info form-control">保存</button>
        {{csrf_field()}}
        {{method_field('PATCH')}}
    </form>
    @include('vendor.ueditor.assets')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@stop

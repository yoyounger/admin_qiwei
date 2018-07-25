@extends('default')
@section('contents')
    <h2>新增活动</h2>
    @include('_errors')
    <br>
    <br>
    <br>
    <form action="{{route('activities.store')}}" method="post">
        <div class="form-group">
            <label for="">活动标题</label>
            <input type="text" class="form-control" placeholder="必填" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="">活动开始时间</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{old('start_time')}}">
        </div>
        <div class="form-group">
            <label for="">活动结束时间</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{old('end_time')}}">
        </div>
        <div>
            <label for="">活动内容</label>
            <textarea id="container" name="contents" type="text/plain" style="height: 400px">{{old('contents')}}</textarea>
        </div>
        <br>
        <button class="btn btn-info form-control">提交</button>
        {{csrf_field()}}
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

@extends('default')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/upload/webuploader.css">
@stop
@section('js_files')
    <script type="text/javascript" src="/upload/webuploader.js"></script>
@stop
@section('contents')
    <h2>修改商家分类</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('shopcategories.update',[$shopcategory])}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>商家分类名</td>
                <td><input type="text" name="name" class="form-control" value="{{$shopcategory->name}}"></td>
            </tr>
            <tr>
                <td>商家分类图片</td>
                <td>
                    <!--dom结构部分-->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>
                    <input type="hidden" name="img" id="img">
                    <img src="{{$shopcategory->img}}" alt="" class="img-circle" width="20%" id="myimg">
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                     <input type="checkbox" value="1" name="status" id="yes" @if($shopcategory->status == 1) checked @endif>&emsp;
                    <label for="yes"><span style="color: red">("✔"为显示,否则为隐藏)</span></label>
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
@section('js')
    <script type="text/javascript">
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            // swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{route('adminImg')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}'
            }
        });
        uploader.on( 'uploadSuccess', function( file,response ) {
            $('#myimg').attr('src',response.filename);
            $('#img').val(response.filename);
        });
    </script>
@stop
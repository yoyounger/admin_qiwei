@extends('default')
@section('contents')
    <h2>修改商家分类</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('shopcategories.update',[$shopcategory])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>商家分类名</td>
                <td><input type="text" name="name" class="form-control" value="{{$shopcategory->name}}"></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td>
                    <input type="file" name="img">
                    <img src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}" alt="" class="img-circle" width="20%">
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
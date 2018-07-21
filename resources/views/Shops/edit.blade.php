@extends('default')
@section('contents')
    <h2>修改商家信息</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('shops.update',[$shop])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center;font-size: 20px;font-weight: bold">店铺信息</td>
            </tr>
            <tr>
                <td>商家名称</td>
                <td><input type="text" name="shop_name" class="form-control" value="{{$shop->shop_name}}"></td>
            </tr>
            <tr>
                <td>店铺分类</td>
                <td>
                    <select name="shop_category_id" id="" class="form-control" >
                        @foreach($categories as $category)
                            @if($category->status)
                        <option value="{{$category->id}}" @if($category->id == $shop->shop_category_id) checked @endif>{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
            </tr>
            <tr>
                <td>店铺图片</td>
                <td>
                    <input type="file" name="shop_img" >
                    <img src="{{$shop->shop_img}}" alt="" width="50px">
                </td>
            </tr>
            <tr>
                <td>评分</td>
                <td>
                    <input type="number" name="shop_rating" class="form-control" value="{{$shop->shop_rating}}">
                </td>
            </tr>
            <tr>
                <td>是否品牌</td>
                <td>
                    <input type="checkbox" value="1" name="brand" id="brand" @if($shop->brand) checked @endif>&emsp;
                    <label for="brand"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否准时送达</td>
                <td>
                    <input type="checkbox" value="1" name="on_time" id="on_time" @if($shop->on_time) checked @endif>&emsp;
                    <label for="on_time"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否蜂鸟配送</td>
                <td>
                    <input type="checkbox" value="1" name="fengniao" id="fengniao" @if($shop->fengniao) checked @endif>&emsp;
                    <label for="fengniao"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否保标记</td>
                <td>
                    <input type="checkbox" value="1" name="bao" id="bao" @if($shop->bao) checked @endif>&emsp;
                    <label for="bao"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否票标记</td>
                <td>
                    <input type="checkbox" value="1" name="piao" id="piao" @if($shop->piao) checked @endif>&emsp;
                    <label for="piao"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否准标记</td>
                <td>
                    <input type="checkbox" value="1" name="zhun" id="zhun" @if($shop->zhun) checked @endif>&emsp;
                    <label for="zhun"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>起送金额</td>
                <td>
                    <input type="number" name="start_send" class="form-control" value="{{$shop->start_send}}">
                </td>
            </tr>
            <tr>
                <td>配送费</td>
                <td>
                    <input type="number" name="send_cost" class="form-control" value="{{$shop->send_cost}}">
                </td>
            </tr>
            <tr>
                <td>店公告</td>
                <td>
                    <input type="text" name="notice" class="form-control" value="{{$shop->notice}}">
                </td>
            </tr>
            <tr>
                <td>优惠信息</td>
                <td>
                    <input type="text" name="discount" class="form-control" value="{{$shop->discount}}">
                </td>
            </tr>
            <tr>
                <td>审核</td>
                <td>
                    <input type="radio" name="status" value="1" id="radio1" @if($shop->status) checked @endif><label for="radio1">正常</label>
                    <input type="radio" name="status" value="0" id="radio2" @if(!$shop->status) checked @endif><label for="radio2">待审核</label>
                    <input type="radio" name="status" value="-1" id="radio3" @if($shop->status == -1) checked @endif><label for="radio3">禁用</label>
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
<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
            'shop_category_id',
            'shop_name',
            'shop_img',
            'shop_rating',
            'brand',
            'on_time',
            'fengniao',
            'bao',
            'piao',
            'zhun',
            'start_send',
            'send_cost',
            'notice',
            'discount',
            'status',
    ];

    //关联商铺分类
    public function shopcatgory()
    {
        return $this->hasOne(ShopCategory::class,'id','shop_category_id');
    }
    //关联账户
    public function user()
    {
        return $this->hasOne(User::class,'shop_id','id');
    }
}

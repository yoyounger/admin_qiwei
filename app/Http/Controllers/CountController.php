<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderGoods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['CountOrder','CountMenu']
        ]);
    }
    //商家的订单量的统计
    public function CountOrder(Request $request)
    {

        $date = substr(date('Y-m-d', time()), 0, 10);
        $month = substr(date('Y-m', time()), 0, 7);
        //累计订单
        $total = Order::count();
        //累计订单排行
        $orders_rank = DB::select("select count(*) as num,shop_name from orders INNER JOIN shops ON orders.shop_id = shops.id GROUP BY shop_id ORDER BY num DESC");

        //本月统计
        $month_total = Order::where('created_at', 'like',"{$month}".'%' )->count();
        //本月排行
        $month_rank = DB::select("select count(*) as num,shop_name from orders INNER JOIN shops ON orders.shop_id = shops.id where orders.created_at like '{$month}%' GROUP BY shop_id ORDER BY num DESC");

        //本日统计
        $day_total = Order::where('created_at', 'like',"{$date}".'%' )->count();
        //本日排行
        $day_rank = DB::select("select count(*) as num,shop_name from orders INNER JOIN shops ON orders.shop_id = shops.id where orders.created_at like '{$date}%' GROUP BY shop_id ORDER BY num DESC");

        //按照某一天进行统计
        if ($request->day){
            $select_daynum = Order::where('created_at', 'like',"{$request->day}".'%' )->count();
            //排行
            $select_dayrank = DB::select("select count(*) as num,shop_name from orders INNER JOIN shops ON orders.shop_id = shops.id where orders.created_at like '{$request->day}%' GROUP BY shop_id ORDER BY num DESC");
        }

        //按照某一月进行统计
        if ($request->month){
            $select_monthnum = Order::where('created_at', 'like',"{$request->month}".'%' )->count();
            //排行
            $select_monthrank = DB::select("select count(*) as num,shop_name from orders INNER JOIN shops ON orders.shop_id = shops.id where orders.created_at like '{$request->month}%' GROUP BY shop_id ORDER BY num DESC");
        }
        //返回选择的时间回显
        $month_date = $request->month;
        $day_date = $request->day;
        return view('Count/orders',compact('orders_rank','total','month_total','month_rank','day_total','day_rank','select_daynum','select_dayrank','select_monthnum','select_monthrank','month_date','day_date'));
    }

    //商家菜品销售统计
    public function CountMenu(Request $request)
    {
        $date = substr(date('Y-m-d', time()), 0, 10);
        $month = substr(date('Y-m', time()), 0, 7);
        //累计统计
        $total = DB::select("select sum(amount) as num from order_goods")[0]->num;
        //累计统计排行
        $menu_totalrank = DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from (SELECT amount,goods_id,menus.shop_id from order_goods
INNER JOIN menus on order_goods.goods_id = menus.id ) as amount_t
INNER JOIN shops on amount_t.shop_id = shops.id
GROUP BY shop_id ORDER BY sum DESC LIMIT 8 ");
        //本月统计
        $month_total = DB::select("select sum(amount) as num from order_goods where created_at like '{$month}%'")[0]->num;
        //本月统计
        $menu_monthrank = DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from 
(SELECT amount,goods_id,menus.shop_id,order_goods.created_at from order_goods 
INNER JOIN menus on order_goods.goods_id = menus.id ) as amount_t 
INNER JOIN shops on amount_t.shop_id = shops.id 
WHERE amount_t.created_at like '{$month}%' GROUP BY shop_id ORDER BY sum DESC LIMIT 8");
        //今日统计
        $day_total =  DB::select("select sum(amount) as num from order_goods where created_at like '{$date}%'")[0]->num;
        //今日统计
        $menu_dayrank = DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from 
(SELECT amount,goods_id,menus.shop_id,order_goods.created_at from order_goods 
INNER JOIN menus on order_goods.goods_id = menus.id ) as amount_t 
INNER JOIN shops on amount_t.shop_id = shops.id 
WHERE amount_t.created_at like '{$date}%' GROUP BY shop_id ORDER BY sum DESC LIMIT 8");
        //按照某一天进行统计
        if ($request->day){
            $select_daynum =OrderGoods::where('created_at', 'like',"{$request->day}".'%' )->count();
            //排行
            $select_dayrank = DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from 
(SELECT amount,goods_id,menus.shop_id,order_goods.created_at from order_goods 
INNER JOIN menus on order_goods.goods_id = menus.id ) as amount_t 
INNER JOIN shops on amount_t.shop_id = shops.id 
WHERE amount_t.created_at like '{$request->day}%' GROUP BY shop_id ORDER BY sum DESC LIMIT 8");
        }

        //按照某一月进行统计
        if ($request->month){
            $select_monthnum = Order::where('created_at', 'like',"{$request->month}".'%' )->count();
            //排行
            $select_monthrank = DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from 
(SELECT amount,goods_id,menus.shop_id,order_goods.created_at from order_goods 
INNER JOIN menus on order_goods.goods_id = menus.id ) as amount_t 
INNER JOIN shops on amount_t.shop_id = shops.id 
WHERE amount_t.created_at like '{$request->month}%' GROUP BY shop_id ORDER BY sum DESC LIMIT 8");
        }
        //返回选择的时间回显
        $month_date = $request->month;
        $day_date = $request->day;
        return view('Count/menus',compact('total','month_total','day_total','menu_totalrank','menu_monthrank','menu_dayrank','select_daynum','select_monthnum','select_dayrank','select_monthrank','month_date','day_date'));
    }
}

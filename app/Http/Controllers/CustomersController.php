<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //会员列表
    public function index(Request $request)
    {
        $username = $request->username;
        $tel = $request->tel;
        $where = [];
        if ($username){
            $where[] = ['username','like','%'.$username.'%'];
        }
        if ($tel){
            $where[]= ['tel','like','%'.$tel.'%'];
        }
        $data = [
            'username'=>$username,
            'tel'=>$tel,
        ];
        $customers = Customer::where($where)->paginate(8);
        return view('Customers/index',compact('customers','data'));
    }
    //查看会员信息
    public function show(Customer $customer)
    {
           $addresses = Address::where('user_id',$customer->id)->get();
           return view('Customers/show',compact('addresses','customer'));
    }
    //修改状态
    public function change(Request $request)
    {
        if ($request->status == 0){
            Customer::where('id',$request->id)->update([
                'status'=>1
            ]);
        }
        if ($request->status == 1){
            Customer::where('id',$request->id)->update([
                'status'=>0
            ]);
        }
        return back()->with('success','修改成功!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //账户列表
    public function index()
    {
        $users = User::paginate(10);
        return view('Users/index',compact('users'));
    }
    //修改商家账户状态
    public function no(Request $request)
    {


        if($request->status == 0){
            User::where('id','=',$request->id)->first()->update(['status'=>1]);
        }elseif ($request->status == 1){
            User::where('id','=',$request->id)->first()->update(['status'=>0]);
        };
        return back();
    }
    //删除账户
    public function destroy(User $user)
    {
        Shop::where('id','=',$user->shop_id)->delete();
        $user->delete();
        return redirect()->route('users.index')->with('success','删除成功!');
    }
}

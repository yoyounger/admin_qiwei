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
    //重置账户密码
    public function set(User $user)
    {
        return view('Users/password',compact('user'));
    }

    public function repassword(User $user,Request $request)
    {
        $this->validate($request,[
            'newpassword'=>'required|min:6',
        ],[
            'newpassword.required'=>'新密码不能为空!',
            'newpassword.min'=>'新密码至少6位!',
        ]);
            if ($request->newpassword !=$request->repassword){
                return back()->with('danger','新密码与确认密码不匹配!')->withInput();
            }
            $user->update(['password'=>bcrypt($request->newpassword)]);

            return redirect()->route('users.index')->with('success','修改密码成功!');
        }
}

<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    //登录验证
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ],[
            'name.required'=>'用户名不能为空!',
            'password.required'=>'密码不能为空!',
            'captcha.required'=>'验证码不能为空!',
            'captcha.captcha'=>'验证码错误!',
        ]);
        if (Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ],$request->remember)){
            session()->flash('success','登录成功!');
            return redirect()->route('admins.index');
        }else{
           return redirect()->route('admins.index')->with('danger','登录失败!');
        }
    }
    //退出登录
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('admins.index')->with('success','注销成功!');
    }
    //修改密码
    public function reset()
    {
        return view('Sessions/password');
    }

    public function password(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required',
            'newpassword'=>'required|min:6',
        ],[
            'oldpassword.required'=>'旧密码不能为空!',
            'newpassword.required'=>'新密码不能为空!',
            'newpassword.min'=>'新密码至少6位!',
        ]);
        if ($request->newpassword !=$request->repassword){
            return back()->with('danger','新密码与确认密码不匹配!')->withInput();
        }
        if ($request->newpassword ==$request->oldpassword){
            return back()->with('danger','新密码不能与旧密码相同!')->withInput();
        }
        $id = Auth::user()->id;
        $row = Admin::where('id',$id)->select('password')->first();
        if (!Hash::check($request->oldpassword,$row->password)){
            return back()->with('danger','旧密码错误!')->withInput();
        }else{
            Admin::where('id',$id)->update(['password'=>bcrypt($request->newpassword)]);
            //修改成功注销
            Auth::logout();
            return redirect()->route('admins.index')->with('success','修改密码成功!请重新登录!');
        }



    }
}

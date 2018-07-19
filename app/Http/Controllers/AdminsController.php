<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    //管理员列表
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('Admins/index',compact('admins'));
    }
    //新增管理员
    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        if ($request->repassword!=$request->password){
            return back()->with('danger','密码与确认密码不一致!')->withInput();
        }
        $this->validate($request,[
            'name'=>'required|max:20',
            'password'=>'required|min:6',
            'email'=>'required',
        ],[
            'name.required'=>'名称不能为空!',
            'name.max'=>'名称不能超过20字!',
            'password.required'=>'密码不能为空!',
            'password.min'=>'密码至少6位!',
            'email.required'=>'邮箱不能为空!',
        ]);
        Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
        ]);
        return redirect()->route('admins.index')->with('success','添加成功!');
    }
    //修改管理员账号
    public function edit(Admin $admin)
    {
        return view('Admins/edit',compact('admin'));
    }

    public function update(Admin $admin,Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:20',
            'email'=>'required',
        ],[
            'name.required'=>'名称不能为空!',
            'name.max'=>'名称不能超过20字!',
            'email.required'=>'邮箱不能为空!',
        ]);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return redirect()->route('admins.index')->with('success','修改成功!');
    }
    //删除管理员账号
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除成功!');
    }

}

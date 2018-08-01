<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //角色管理列表
    public function index()
    {
        $roles = Role::paginate(10);
        return view('Roles.index',compact('roles'));
    }
    //添加角色
    public function create()
    {
        $permissions = Permission::all();
        return view('Roles/create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'permissions'=>'required',
        ],[
            'name.required'=>'角色名称不能为空!',
            'permissions.required'=>'必须选择角色权限!'
        ]);
        $res = Role::where('name',$request->name)->first();
        if ($res){
            return back()->with('danger','名称已存在')->withInput();
        }
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success','添加成功!');
    }
    //查看
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('Roles/show',compact('role','permissions'));
    }
    //修改
    public function edit(Role $role)
    {
        //获取所有的权限
        $permissions = Permission::all();
        return view('Roles/edit',compact('role','permissions'));
    }

    public function update(Role $role,Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'permissions'=>'required',
        ],[
            'name.required'=>'角色名称不能为空!',
            'permissions.required'=>'必须选择角色权限!'
        ]);
        $role->update(['name'=>$request->name]);
        $role->syncPermissions([$request->permissions]);
        return redirect()->route('roles.index')->with('success','修改成功!');
    }
    //删除角色
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success','删除成功!');
    }
}

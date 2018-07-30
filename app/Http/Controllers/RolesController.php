<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
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
        $permissions = DB::select("SELECT name from role_has_permissions
INNER JOIN permissions on role_has_permissions.permission_id = permissions.id 
WHERE '{$role->id}'");
        return view('Roles/show',compact('role','permissions'));
    }
}

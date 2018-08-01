<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //权限列表
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('Permissions/index',compact('permissions'));
    }
    //添加权限
    public function create()
    {
        return view('Permissions/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'权限名称不能为空!'
        ]);
        $permission = Permission::create(['name'=>$request->name]);
        return redirect()->route('permissions.index')->with('success','添加成功!');
    }
    //修改权限
    public function edit(Permission $permission)
    {
        return view('Permissions.edit',compact('permission'));
    }

    public function update(Request $request,Permission $permission)
    {
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'权限名称不能为空!'
        ]);
        $permission->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('permissions.index')->with('success','修改成功!');
    }
    //删除权限
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','删除成功!');
    }
}

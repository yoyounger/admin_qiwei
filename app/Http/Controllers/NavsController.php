<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class NavsController extends Controller
{
    //导航菜单列表
    public function index()
    {
        $navs = Nav::paginate(10);
        return view('Navs/index',compact('navs'));
    }
    //添加导航菜单
    public function create()
    {
        if (!Auth::user()->can('导航菜单管理增删改')){
            return view('403');
        }
        $permissions = Permission::all();
        $navs = Nav::where('pid',0)->get();
        return view('Navs/create',compact('permissions','navs'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:15|unique:navs',
            'url'=>'required',
            'pid'=>'required',
            'permission_id'=>'required',
        ],[
            'name.required'=>'菜单名不能为空!',
            'name.max'=>'菜单名不能超过15字!',
            'name.unique'=>'已存在的菜单名!',
            'url.required'=>'链接地址不能为空!',
            'permission_id'=>'必须选择一个权限!'
        ]);
        Nav::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id,
        ]);
        return redirect()->route('navs.index')->with('success','添加成功!');
    }
    //修改
    public function edit(Nav $nav)
    {
        if (!Auth::user()->can('导航菜单管理增删改')){
            return view('403');
        }
        $permissions = Permission::all();
        $navs = Nav::where([['pid',0],['id','<>',$nav->id]])->get();
        return view('Navs/edit',compact('nav','navs','permissions'));
    }

    public function update(Nav $nav,Request $request)
    {
        $this->validate($request,[
            'name' => [
                'required',
                'max:15',
                Rule::unique('navs')->ignore($nav->id),
            ],
            'url'=>'required',
            'pid'=>'required',
            'permission_id'=>'required',
        ],[
            'name.required'=>'菜单名不能为空!',
            'name.max'=>'菜单名不能超过15字!',
            'name.unique'=>'已存在的菜单名!',
            'url.required'=>'链接地址不能为空!',
            'permission_id'=>'必须选择一个权限!'
        ]);
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id,
        ]);
        return redirect()->route('navs.index')->with('success','修改成功!');
    }
    //删除菜单
    public function destroy(Nav $nav)
    {
        if (!Auth::user()->can('导航菜单管理增删改')){
            return view('403');
        }
        $res = Nav::where('pid',$nav->id)->first();
        if ($res){
            return back()->with('danger','该分类下有菜单不能删除!')->withInput();
        }
        $nav->delete();
        return redirect()->route('navs.index')->with('success','删除成功!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //管理员列表
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('Admins/index',compact('admins'));
    }
    //权限查看
    public function show(Admin $admin)
    {
        //管理员角色返回集合
        $collection = $admin -> getRoleNames();
        //取出集合里的数据
        $roles = collect($collection)->all();
        //角色权限返回集合
        $collection_per = $admin->getAllPermissions();
        //取出集合里的数据
        $permissions = collect($collection_per)->all();
       return view('Admins/show',compact('admin','roles','permissions'));
    }
    //新增管理员
    public function create()
    {
        if (!Auth::user()->can('管理员添加')){
            return view('403');
        }
        $roles = Role::all();
        return view('Admins/create',compact('roles'));
    }

    public function store(Request $request)
    {
        if ($request->repassword!=$request->password){
            return back()->with('danger','密码与确认密码不一致!')->withInput();
        }
        $this->validate($request,[
            'name'=>'required|max:20|unique:admins',
            'password'=>'required|min:6',
            'email' =>'required|email|unique:admins',
            'roles'=>'required',
        ],[
            'name.required'=>'名称不能为空!',
            'name.max'=>'名称不能超过20字!',
            'name.unique'=>'该用户名已经存在!',
            'password.required'=>'密码不能为空!',
            'password.min'=>'密码至少6位!',
            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱格式错误!',
            'email.unique'=>'该邮箱已经存在!',
            'roles.required'=>'必须分配角色给管理员!'
        ]);
        $admin = Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
        ]);
        $admin->assignRole($request->roles);
        return redirect()->route('admins.index')->with('success','添加成功!');
    }
    //修改管理员账号
    public function edit(Admin $admin)
    {
        if (!Auth::user()->can('管理员修改')){
            return view('403');
        }
        $roles = Role::all();
        //管理员角色返回集合
        $collection = $admin -> getRoleNames();
        //取出集合里的数据
        $roles_admin = collect($collection)->all();
        return view('Admins/edit',compact('admin','roles','roles_admin'));
    }

    public function update(Admin $admin,Request $request)
    {
//        dd($request->roles);
        $this->validate($request,[
            'name' => [
                'required','max:20',
                Rule::unique('admins')->ignore($admin->id),
            ],
            'email' => [
                'required','email',
                Rule::unique('admins')->ignore($admin->id),
            ],
        ],[
            'name.required'=>'名称不能为空!',
            'name.unique'=>'该用户名已经存在!',
            'name.max'=>'名称不能超过20字!',
            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱格式错误!',
            'email.unique'=>'该邮箱已经存在!',
        ]);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        $admin->syncRoles([$request->roles]);
        return redirect()->route('admins.index')->with('success','修改成功!');
    }
    //删除管理员账号
    public function destroy(Admin $admin)
    {
        if (!Auth::user()->can('管理员删除')){
            return view('403');
        }
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除成功!');
    }

}

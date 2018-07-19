<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoriesController extends Controller
{
    //分类列表
    public function index()
    {
        $shopcategories = ShopCategory::paginate(10);
        return view('ShopCategory/index',compact('shopcategories'));
    }
    //添加分类
    public function create()
    {
        return view('ShopCategory/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'img'=>'required',
        ],[
            'name.required'=>'分类名称不能为空!',
            'name.max'=>'分类名不能超过10个字',
            'img.required'=>'分类图片不能为空!',
        ]);
        $status = $request->status??0;
        $img = $request->file('img')->store('public/img');
        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$img,
            'status'=>$status,
        ]);
        return redirect()->route('shopcategories.index')->with('success','添加成功!');
    }
    //修改分类
    public function edit(ShopCategory $shopcategory)
    {
        return view('ShopCategory/edit',compact('shopcategory'));
    }

    public function update(ShopCategory $shopcategory,Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
        ],[
            'name.required'=>'分类名称不能为空!',
            'name.max'=>'分类名不能超过10个字',
        ]);
        $status = $request->status??0;
        $img = $request->file('img');
        $data = [
            'name'=>$request->name,
            'status'=>$status,
        ];
        if ($img){
            $data['img']=$img->store('public/img');
        }
        $shopcategory->update($data);
        return redirect()->route('shopcategories.index')->with('success','修改成功!');
    }
    //删除分类
    public function destroy(ShopCategory $shopcategory)
    {
        $shopcategory->delete();
        return redirect()->route('shopcategories.index')->with('success','删除成功!');
    }
}

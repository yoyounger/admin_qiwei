<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }

    //活动列表
    public function index(Request $request)
    {
        $time = date('Y-m-d H:i:s',time());
        $status = $request->act_status;
        if ($status==1){
            $activities = Activity::where([
                ['start_time','<=',$time],
                ['end_time','>=',$time],
                ])->paginate(5);
        }
        elseif ($status==0){
            $activities = Activity::where([
                ['start_time','>',$time],
            ])->paginate(5);
        }
        elseif($status==-1){
            $activities = Activity::where([
                ['end_time','<',$time],
            ])->paginate(5);
        }
        if ($status==2 || $status==null){
            $activities = Activity::paginate(5);
        }


        return view('Activities/index',compact('activities'));
    }

    public function show(Activity $activity)
    {
        return view('Activities/show',compact('activity'));
    }
    //添加店铺活动
    public function create()
    {
        if (!Auth::user()->can('添加活动')){
            return view('403');
        }
        return view('Activities/create');
    }

    public function store(Request $request)
    {
        dd($request->start_time);
        $this->validate($request,[
            'title'=>'required',
            'start_time'=>'required|date|after:yesterday',
            'end_time'=>'required|date|after:start_time',
            'contents'=>'required',
        ],[
            'title.required'=>'活动标题不能为空!',
            'start_time.required'=>'请选择活动开始时间!',
            'start_time.date'=>'开始时间必须是时间格式!',
            'start_time.after'=>'开始时间已过期!',
            'end_time.required'=>'请选择活动结束时间!',
            'end_time.date'=>'结束时间必须是时间格式!',
            'end_time.after'=>'结束时间必须在开始时间之后!',
            'contents.required'=>'活动内容不能为空!'
        ]);
        Activity::create([
            'title'=>$request->title,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'content'=>$request->contents,
        ]);
        return redirect()->route('activities.index')->with('success','添加活动成功!');
    }
    //修改店铺活动
    public function edit(Activity $activity)
    {
        if (!Auth::user()->can('活动修改')){
            return view('403');
        }
        return view('Activities/edit',compact('activity'));
    }

    public function update(Activity $activity,Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'start_time'=>'required|date|after:yesterday',
            'end_time'=>'required|date|after:start_time',
            'contents'=>'required',
        ],[
            'title.required'=>'活动标题不能为空!',
            'start_time.required'=>'请选择活动开始时间!',
            'start_time.date'=>'开始时间必须是时间格式!',
            'start_time.after'=>'开始时间已过期!',
            'end_time.required'=>'请选择活动结束时间!',
            'end_time.date'=>'结束时间必须是时间格式!',
            'end_time.after'=>'结束时间必须在开始时间之后!',
            'contents.required'=>'活动内容不能为空!'
        ]);
        $activity->update([
            'title'=>$request->title,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'content'=>$request->contents,
        ]);
        return redirect()->route('activities.index')->with('success','修改活动成功!');
    }
    //删除活动
    public function destroy(Activity $activity)
    {

        if (!Auth::user()->can('活动删除')){
            return view('403');
        }
        $activity->delete();
        return redirect()->route('activities.index')->with('success','删除活动成功!');
    }
}

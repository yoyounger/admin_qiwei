<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    //显示抽奖活动
    public function index()
    {
        $events = Event::paginate(10);
        return view('Events/index',compact('events'));
    }

    //查看抽奖
    public function show(Event $event)
    {
        return view('Events/show',compact('event'));
    }
    //添加抽奖
    public function create()
    {
        if (!Auth::user()->can('添加抽奖活动')){
            return view('403');
        }
        return view('Events/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:30',
            'contents'=>'required',
            'signup_start'=>'required|date|after:today',
            'signup_end'=>'required|date|after:signup_start',
            'prize_date'=>'required|date|after:signup_end',
            'signup_num'=>'required',
        ],[
            'title.required'=>'活动名称不能为空!',
            'signup_start.required'=>'请选择活动报名开始时间!',
            'signup_start.date'=>'报名开始时间必须是时间格式!',
            'signup_start.after'=>'报名开始时间已过期!',
            'signup_end.required'=>'请选择活动结束时间!',
            'signup_end.date'=>'报名结束时间必须是时间格式!',
            'signup_end.after'=>'报名结束时间必须在开始时间之后!',
            'contents.required'=>'活动内容不能为空!',
            'prize_date.required'=>'请选择活动开奖时间!',
            'prize_date.date'=>'开奖时间必须是时间格式!',
            'prize_date.after'=>'开奖时间必须在报名结束时间之后!',
            'signup_num.required'=>'人数限制不能为空!'
        ]);
        Event::create([
            'title'=>$request->title,
            'content'=>$request->contents,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        return redirect()->route('events.index')->with('success','添加成功!');
    }
    //修改抽奖
    public function edit(Event $event)
    {
        if (!Auth::user()->can('修改抽奖活动')){
            return view('403');
        }
        return view('Events/edit',compact('event'));
    }

    public function update(Request $request,Event $event)
    {
        $this->validate($request,[
            'title'=>'required|max:30',
            'contents'=>'required',
            'signup_start'=>'required|date|after:yesterday',
            'signup_end'=>'required|date|after:signup_start',
            'prize_date'=>'required|date|after:signup_end',
            'signup_num'=>'required',
        ],[
            'title.required'=>'活动名称不能为空!',
            'signup_start.required'=>'请选择活动报名开始时间!',
            'signup_start.date'=>'报名开始时间必须是时间格式!',
            'signup_start.after'=>'报名开始时间已过期!',
            'signup_end.required'=>'请选择活动结束时间!',
            'signup_end.date'=>'报名结束时间必须是时间格式!',
            'signup_end.after'=>'报名结束时间必须在开始时间之后!',
            'contents.required'=>'活动内容不能为空!',
            'prize_date.required'=>'请选择活动开奖时间!',
            'prize_date.date'=>'开奖时间必须是时间格式!',
            'prize_date.after'=>'开奖时间必须在报名结束时间之后!',
            'signup_num.required'=>'人数限制不能为空!'
        ]);
        $event->update([
            'title'=>$request->title,
            'content'=>$request->contents,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        return redirect()->route('events.index')->with('success','修改成功!');
    }
    //删除抽奖
    public function destroy(Event $event)
    {
        if (!Auth::user()->can('删除抽奖活动')){
            return view('403');
        }
        $event->delete();
        return redirect()->route('events.index')->with('success','删除成功!');
    }
}

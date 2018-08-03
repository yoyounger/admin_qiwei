<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventPrizesController extends Controller
{
    //奖品列表
    public function index(Request $request)
    {
        if (!Auth::user()->can('查看报名和奖品')){
            return view('403');
        }
        $eventprizes = EventPrize::where('events_id',$request->events_id)->paginate(10);
        $event = Event::where('id',$request->events_id)->first();
        return view('EventPrizes/index',compact('eventprizes','event'));
    }
    //添加奖品
    public function create(Request $request)
    {
        if (!Auth::user()->can('添加奖品')){
            return view('403');
        }
        $events = Event::all();
        $events_id = $request->events_id;
        return view('EventPrizes/create',compact('events','events_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:15',
        ],[
            'name.required'=>'奖品名称不能为空!',
            'name.max'=>'奖品名称不能超过15字!',
        ]);
        EventPrize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description??'无',
        ]);
        return redirect()->route('eventprizes.index',['events_id'=>$request->events_id])->with('success','添加成功!');
    }
    //修改奖品
    public function edit(EventPrize $eventprize)
    {
        if (!Auth::user()->can('修改奖品')){
            return view('403');
        }
        return view('EventPrizes/edit',compact('eventprize'));
    }

    public function update(Request $request,EventPrize $eventprize)
    {

        $this->validate($request,[
            'name'=>'required|max:15',
        ],[
            'name.required'=>'奖品名称不能为空!',
            'name.max'=>'奖品名称不能超过15字!',
        ]);
        $eventprize->update([
            'name'=>$request->name,
            'description'=>$request->description??'无',
        ]);
        return redirect()->route('eventprizes.index',['events_id'=>$eventprize->events_id])->with('success','修改成功!');
    }
    //删除奖品
    public function destroy(EventPrize $eventprize)
    {
        if (!Auth::user()->can('删除奖品')){
            return view('403');
        }
        $eventprize->delete();
        return redirect()->route('eventprizes.index',['events_id'=>$eventprize->events_id])->with('success','删除成功!');
    }
}

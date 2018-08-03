<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventMembersController extends Controller
{
    //显示参与抽奖人员列表
    public function index(Request $request)
    {
        if (!Auth::user()->can('查看报名和奖品')){
            return view('403');
        }
        $eventmembers = EventMember::where('events_id', $request->id)->paginate(10);
        return view('EventMembers/index', compact('eventmembers'));
    }

    //抽奖
    public function prize(Request $request)
    {
        if (!Auth::user()->can('抽奖')){
            return view('403');
        }
        //获取活动id
        $events_id = $request->id;
        $event = Event::where('id', $events_id)->first();
        //根据id取出对应奖品的id
        $prizes = EventPrize::where('events_id', $events_id)->get();
        $prizes_id = [];
        foreach ($prizes as $prize) {
            array_push($prizes_id, $prize->id);
        }
        //取出参与抽奖的商家账户的id
        $eventmembers = EventMember::where('events_id', $events_id)->get();
        $users_id = [];
        foreach ($eventmembers as $eventmember) {
            array_push($users_id, $eventmember->member_id);
        }
        //随机打乱奖品
        shuffle($users_id);
        shuffle($prizes_id);
        //抽奖
        foreach ($prizes_id as $key=>$prize_id){
            if (!isset($users_id[$key])){
                break;
            }
            $event_prize = EventPrize::where('id', $prize_id)->first();
            $event_prize->update([
                'member_id' => $users_id[$key]
            ]);
            //发送邮件
            $user = User::where('id',$users_id[$key])->first();
            Mail::raw('尊敬的'.$user->name.'恭喜您在'.$event->title.'活动中中奖啦!!,请登录查看!!!',function ($message) use($user){
                $message->subject('活动中奖通知');
                $message->to($user->email);
            });
        }
        //抽奖完成修改活动状态

        $event->update([
            'is_prize'=>1
        ]);
        return redirect()->route('eventprizes.index',['events_id'=>$events_id])->with('success','抽奖成功!');
    }


}

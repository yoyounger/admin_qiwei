<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable = [
        'events_id',
        'name',
        'description',
        'member_id',
    ];
    public function event(){
        return $this->hasOne(Event::class);
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','member_id');
    }
}

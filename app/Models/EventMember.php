<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    protected $fillable = [
        'events_id',
        'member_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','member_id');
    }
}

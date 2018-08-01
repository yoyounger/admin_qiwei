<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    protected $fillable = [
        'name','url','permission_id','pid'
    ];

    public function permission()
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }

    public function nav()
    {
        return $this->hasOne(Nav::class,'id','pid');
    }
}

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
        return $this->hasOne(self::class,'id','pid');
    }

    public static function getHtml()
    {
        $html = '';
        foreach(self::where('pid',0)->get() as $nav){
            $chilhtml = '';
            foreach(self::where('pid',$nav->id)->get() as $val){
                if (auth()->user()&&auth()->user()->can($val->permission->name)){
                    $chilhtml .='<li><a href="'.$val->url.'">'.$val->name.'</a></li>';
                }
            }
                if (empty($chilhtml)){
                    continue;
                }
            $html .='
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle list-group-item" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">'.$nav->name.'<span class="caret"></span></a>
                        <ul class="dropdown-menu">';
            $html .=$chilhtml;
            $html .='</ul>
                    </li>';
        }
        return $html;

    }
}

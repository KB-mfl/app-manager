<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //protected $table = 'data';
    protected $hidden = ['app_id'];
    /*
        一条 data 只由一个 App 拥有
    */
    public function app() {
        return $this->belongsTo('App\App');
    }
}

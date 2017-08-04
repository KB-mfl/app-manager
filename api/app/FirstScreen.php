<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirstScreen extends Model
{
    protected $table = 'first_screen';
    /*
        一个首屏推送属于一个app
    */
    public function app() {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
}

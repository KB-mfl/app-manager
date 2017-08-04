<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use SoftDeletes;
    protected $table = 'app';
    protected $data = ['deleted_at'];
    protected $hidden = ['user_id'];
    /*
        一个App只能由一个用户管理
    */
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    /*
        一个APP有多个 data  systrm  feedback  first_screen
    */
    public function data() {
        return $this->hasMany('App\Data', 'app_id', 'id');
    }
    public function feedback() {
        return $this->hasMany('App\Feedback', 'app_id', 'id');
    }
    public function first_screen() {
        return $this->hasMany('App\FirstScreen', 'app_id', 'id');
    }
    public function system() {
        return $this->hasMany('App\System', 'app_id', 'id');
    }
}

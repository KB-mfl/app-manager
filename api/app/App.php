<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use SoftDeletes;
    //protected $table = 'apps';
    protected $data = ['deleted_at'];
    protected $hidden = ['user_id'];
    /*
        一个App只能由一个用户管理
    */
    public function user() {
        return $this->belongsTo('App\User');
    }
    /*
        一个APP有多个 data 和 history 版本
    */
    public function data() {
        return $this->hasMany('App\Data');
    }

    public function history() {
        return $this->hasMany('App\History');
    }
}

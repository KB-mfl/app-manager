<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $hidden = ['password'];
    /*
        一个用户可以管理多个app
    */
    public function apps() {
        return $this->hasMany('App\App', 'user_id', 'id');
    }
    public function feedback() {
        return $this->hasMany('App\Feedback', 'user_id', 'id');
    }
}

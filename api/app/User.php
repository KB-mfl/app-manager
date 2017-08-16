<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'user';
    //protected $visiable = ['id'];
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
    public function apitokens() {
        return $this->hasMany('App\ApiToken', 'user_id', 'id');
    }
}

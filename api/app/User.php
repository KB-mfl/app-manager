<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //protected $table = 'users';
    protected $hidden = ['password'];
    /*
        一个用户可以管理多个app
    */
    public function apps() {
        return $this->hasMany('App\App');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;
    //protected $table = 'histories';
    protected $data = ['deleted_at'];
    protected $hidden = ['app_id', 'varsion_id', 'updated_at'];
    /*
        一个 history 版本信息只由一个 APP 拥有
    */
    public function app() {
        return $this->belongsTo('App\App');
    }
}

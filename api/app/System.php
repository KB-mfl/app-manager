<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    use SoftDeletes;
    protected $table = 'system';
    protected $data = ['deleted_at'];
    /*
        一个app有多个系统
    */
    public function app() {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
    /*
        有多个版本属于这个系统
    */
    public function version() {
        return $this->hasMany('App\Version', 'system_id', 'id');
    }
}

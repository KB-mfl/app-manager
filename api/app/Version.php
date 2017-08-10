<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use SoftDeletes;
    protected $table = 'version';
    protected $data = ['deleted_at'];
    //protected $hidden = ['updated_at'];
    /*
        一个 version 版本信息只由一个 System 拥有
    */
    public function system() {
        return $this->belongsTo('App\System', 'system_id', 'id');
    }
}

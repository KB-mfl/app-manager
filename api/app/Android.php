<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Android extends Model
{
    use SoftDeletes;
    protected $table = 'android';

    public function app () {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
}

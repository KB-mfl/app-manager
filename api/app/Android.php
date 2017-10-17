<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Android extends Model
{
    protected $table = 'android';

    public function app () {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
}

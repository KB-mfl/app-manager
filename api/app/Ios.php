<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ios extends Model
{
    protected $table = 'ios';

    public function app() {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
}

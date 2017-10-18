<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ios extends Model
{
    use SoftDeletes;
    protected $table = 'ios';

    public function app() {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
}

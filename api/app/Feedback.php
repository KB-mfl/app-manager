<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    //protected $hidden = ['user'];

    /*
        一个feedback属于一个feedback，一个app，一个user
    */
    public function app() {
        return $this->belongsTo('App\App', 'app_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function replyTo() {
        return $this->belongsTo('App\Feedback', 'feedback_id', 'id');
    }
    /*
        一个feedback拥有多个feedback
    */
    public function replyFrom() {
        return $this->hasMany('App\Feedback', 'feedback_id', 'id');
    }
}

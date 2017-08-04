<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AppController extends Controller {
    public function show(Request $request) {
        if(!isset($request['want_deleted']) || $request->want_deleted == false) {
            $apps = App::all();
        }
        else {
            $apps = App::withTrashed()->get();
        }
        return $apps;
    }
    public function create(Request $request) {
      //验证信息
      /*
        $message = [
            'name.required' => '名字不能为空!',
        ];
        Validator::make($request->all(),[
            'name' => 'required',
        ], $message)->validate();
    */
        $app = new App;
        $app->user_id = 1;
        $app->name = $request->name;
        $app->save();
        return $app;
    }
    public function delete(Request $request, $app_id) {
        $app = App::find($request->app_id);
        $app->delete();
        return [];
    }
    public function readd(Request $request, $app_id) {
        $app = App::onlyTrashed()->find($request->app_id);
        $app->restore();
        return $app;
    }
}
<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $app = new App;
        $app->user_id = 1;
        $app->name = $request->name;
        $app->hash_name = $request->hash_name;
        if(isset($request['logo'])) {
            $path_logo = $request->file('logo')->store('imgs');
            $app->logo_url = $path_logo;
        }
        if(isset($request['image'])) {
            $path_img = $request->file('image')->store('imgs');
            $app->image_url = $path_img;
        }
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
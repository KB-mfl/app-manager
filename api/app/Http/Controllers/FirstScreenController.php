<?php

namespace App\Http\Controllers;

use App\FirstScreen;
use App\App;
use Illuminate\Http\Request;

class FirstScreenController extends Controller
{
    public function show(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        $first_screens = $app->first_screen;
        foreach($first_screens as $fs) {
            $fs->image_url = str_replace("public/", "", $fs->image_url);
            $fs->image_url = asset('storage/'.$fs->image_url);
        }
        return $first_screens;
    }
    public function store(Request $request, $app_id) {
        /*
            表单验证
        */
        $app = App::withTrashed()->find($app_id);
        foreach($app->first_screen as $fs) {
            $fs->actived = false;
            $fs->save();
        }
        if(isset($request['file'])) {
            $path = $request->file('file')->store('public/imgs');
        }
        else {
            $path = null;
        }
        $first_screen = new FirstScreen;
        $first_screen->actived = true;
        $first_screen->content = $request->content;
        $first_screen->app_id = $app_id;
        $first_screen->image_url = $path;
        $first_screen->save();
        return $first_screen;
    }
    public function active(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        foreach($app->first_screen as $fs) {
            $fs->actived = false;
            $fs->save();
        }
        $first_screen = FirstScreen::find($request->first_screen_id);
        $first_screen->actived = true;
        $first_screen->save();
        return $first_screen;
    }
    public function delete(Request $request, $app_id) {
        $first_screen = FirstScreen::find($request->first_screen_id);
        $first_screen->delete();
        return [];
    }
}

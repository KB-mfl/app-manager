<?php

namespace App\Http\Controllers;

use App\App;
use App\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function show(Request $request, $app_id) {
        $app = App::find($app_id);
        if(!isset($request['want_deleted']) || $request->want_deleted == false) {
            $system = $app->system()->get();
        }
        else {
            $system = System::withTrashed()->where('app_id', '=', $app_id)->get();
        }
        return $system;
    }
    public function store(Request $request, $app_id) {
        /*
            表单验证
        */
        $system = new System;
        $system->app_id = $request->app_id;
        $system->system = $request->system;
        $system->identification = $request->identification;
        $path = $request->file('file')->store('imgs');
        $system->logo_url = $path;
        $system->save();
        return $system;
    }
    public function delete(Request $request, $app_id) {
        $system = System::find($request->system_id);
        $system->delete();
        return [];
    }
    public function restore(Request $request, $app_id) {
        $system = System::onlyTrashed()->find($request->system_id);
        $system->restore();
        return $system;
    }
}

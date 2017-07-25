<?php

namespace App\Http\Controllers;

use App\History;
use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller {
    public function show(Request $request, $app_id) {
        if(!isset($request['want_deleted']) || $request->want_deleted == false) {
            //$history = History::where()
            $historys = History::all()->where('app_id', '=', $app_id)->take($request->limit);
        }
        else {
            $historys = History::withTrashed()->get()->where('app_id', '=', $app_id)->take($request->limit);
        }
        return $historys;
    }
    public function delete(Request $request, $app_id) {
        $history = History::find($request->history_id);
        $history->delete();
        return [];
    }
    public function recover(Request $request, $app_id) {
        $history = History::onlyTrashed()->find($request->history_id);
        $history->restore();
        return $history;
    }
    public function store(Request $request, $app_id) {
        $history = new History;
        $history->app_id = $app_id;
        $history->varsion = $request->varsion;
        $history->system = $request->system;
        $app = App::find($app_id);
        $now = 0;
        foreach($app->history() as $his) {
            if($his->varsion_id > $now) {
                $now = $his->varsion_id;
            }
        }
        $history->varsion_id = $now + 1;
        $path = $request->file('new_app')->store('apps');
        $history->file_url = $path;
        $history->save();
        return $history;
    }
}
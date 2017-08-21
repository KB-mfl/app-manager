<?php

namespace App\Http\Controllers;

use App\Data;
use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller {
    public function show(Request $request, $app_id) {
        $app = App::withTrashed()->where('id', '=', $app_id)->first();
        $datas = $app->data()->get();
        return $datas;
    }
    public function store(Request $request, $app_id) {
        $data = new Data;
        $data->app_id = $app_id;
        $data->key = $request->key;
        $data->value = $request->value;
        $data->save();
        return $data;
    }
    public function change(Request $request, $app_id) {
        $data = Data::find($request['data_id']);
        $data->key = $request->key;
        $data->value = $request->value;
        $data->save();
        return $data;
    }
    public function delete(Request $request, $app_id) {
        $data = Data::find($request->data_id);
        $data->delete();
        return [];
    }
}
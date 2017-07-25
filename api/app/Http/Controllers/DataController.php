<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller {
    public function show(Request $request, $app_id) {
        $datas = Data::all();
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
        $data = Data::where('key', '=', $request->key)->first();
        $data->value = $request->value;
        $data->save();
        return $data;
    }
    public function delete(Request $request, $app_id) {
        $data = Data::where('key', '=', $request->key)->first();
        $data->delete();
        return [];
    }
}
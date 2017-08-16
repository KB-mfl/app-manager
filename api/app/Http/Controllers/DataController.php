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
        //验证信息
      /*
        要在app_id相同的情形下才判key不重
        $message = [
            'key.required' => 'key不能为空!',
            'value.required' => 'value不能为空!',
            'key.unique' => 'key不能重复!'
        ];
        Validator::make($request->all(),[
            'key' => 'required'|unique:data,key,
            'value' => 'required',
        ], $message)->validate();
    */
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
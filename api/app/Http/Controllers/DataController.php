<?php

namespace App\Http\Controllers;

use App\Data;
use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller {
    /**
    *  @api {get} /api/app/{app_id}/data 获得app数据
    *  @apiName show_data
    *  @apiGroup Data
    *  @apiVersion v2.0.0
    *  @apiParamExample {json} [example]
    *  {
    *
    *  }
    *  @apiSuccess {json} Data 返回app的所有数据
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": 1,
    *        "app_id": "1",
    *        "key": "key1"
    *        "value": "value1",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": 2,
    *        "app_id": "1",
    *        "key": "key2"
    *        "value": "value2",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request, $app_id) {
        $app = App::withTrashed()->where('id', '=', $app_id)->first();
        if(! $app) abort(404);
        $datas = $app->data;
        $response = [];
        foreach($datas as $key => $data) {
            $response[$key] = [
                'id' => $data->id,
                'app_id' => $app_id,
                'key' => $data->key,
                'value' => $data->value,
                'created_at' => $data->created_at->timestamp,
                'updated_at' => $data->updated_at->timestamp,
            ];
        }
        return $response;
    }
    /**
    *  @api {post} /api/app/{app_id}/data 添加app数据
    *  @apiName add_data
    *  @apiGroup Data
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {string} key 数据的关键词
    *  @apiParam (MUST) {string} value 数据的值
    *  @apiParamExample {json} [example]
    *  {
    *    "key": "key3",
    *    "value": "value3",
    *  }
    *  @apiSuccess {json} Data 返回新增数据
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": 3,
    *        "app_id": "1",
    *        "key": "key3"
    *        "value": "value3",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            'key' => 'required|string',
            'value' => 'required|string',
        ]);
        $data = new Data;
        $has = Data::where('app_id', '=', $app_id)->where('key', '=', $request->key)->first();
        if($has !== null) abort(555);
        $data->app_id = $app_id;
        $data->key = $request->key;
        $data->value = $request->value;
        $data->save();
        $response = [
            'id' => $data->id,
            'app_id' => $app_id,
            'key' => $data->key,
            'value' => $data->value,
            'created_at' => $data->created_at->timestamp,
            'updated_at' => $data->updated_at->timestamp,
        ];
        return $response;
    }
    /**
    *  @api {put} /api/app/{app_id}/data 修改app数据
    *  @apiName change_data
    *  @apiGroup Data
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {integer} data_id 要修改的data的id
    *  @apiParam (Nullable) {string} key 数据的关键词
    *  @apiParam (Nullable) {string} value 数据的值
    *  @apiParamExample {json} [example]
    *  {
    *    "key": "key3_change",
    *    "value": "value3_change",
    *  }
    *  @apiSuccess {json} Data 返回修改后的数据
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": 3,
    *        "app_id": "1",
    *        "key": "key3_change"
    *        "value": "value3_change",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function change(Request $request, $app_id) {
        $this->validate($request, [
            'data_id' => 'required|integer|min:1',
            'key' => 'required|string',
            'value' => 'required|string',
        ]);
        $data = Data::find($request['data_id']);
        if(isset($request['key']) && $request['key'] !== null) {
            $has = Data::where('app_id', '=', $app_id)->where('key', '=', $request->key)->first();
            if($has !== null && $has->id != $request->data_id) abort(555);
            $data->key = $request->key;
        }
        if(isset($request['value']) && $request['value'] !== null) $data->value = $request->value;
        $data->save();
        $response = [
            'id' => $data->id,
            'app_id' => $app_id,
            'key' => $data->key,
            'value' => $data->value,
            'created_at' => $data->created_at->timestamp,
            'updated_at' => $data->updated_at->timestamp,
        ];
        return $response;
    }
    /**
    *  @api {put} /api/app/{app_id}/data 删除app数据
    *  @apiName delete_data
    *  @apiGroup Data
    *  @apiVersion v2.0.0
    *  @apiParam (must) {integer} data_id 数据的id
    *  @apiParamExample {json} [example]
    *  {
    *    "data_id": "3",
    *  }
    *  @apiSuccess {json} Data 返回空
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       []
    */
    public function delete(Request $request, $app_id) {
        $this->validate($request, [
            'data_id' => 'required|integer|min:1',
        ]);
        $data = Data::find($request->data_id);
        if(! $data) abort(404);
        $data->delete();
        return [];
    }
}
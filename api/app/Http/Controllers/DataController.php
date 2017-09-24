<?php

namespace App\Http\Controllers;

use App\Data;
use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller {
    /**
    *  @api {get} /api/{app_id}/data 获得app数据
    *  @apiName show_data
    *  @apiGroup Data
    *  @apiVersion v1.0.0
    *  @apiParamExample {json} [example]
    *  {
    *  }
    *  @apiSuccess {json} Data 返回修改后的数据
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "app_id": "1",
    *        "key": "key1"
    *        "value": "value1",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "app_id": "1",
    *        "key": "key2"
    *        "value": "value2",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request, $app_id) {
        // $this->validate($request, [
        //     'app_id' => 'required|integer|min:1',
        // ]);
        $app = App::withTrashed()->where('id', '=', $app_id)->first();
        $datas = $app->data()->get();
        return $datas;
    }
    /**
    *  @api {post} /api/{app_id}/data 添加app数据
    *  @apiName add_data
    *  @apiGroup Data
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} key 数据的关键词
    *  @apiParam (must) {string} value 数据的值
    *  @apiParamExample {json} [example]
    *  {
    *    "key": "key3",
    *    "value": "value3",
    *  }
    *  @apiSuccess {json} Data 返回新增数据
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "app_id": "1",
    *        "key": "key3"
    *        "value": "value3",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            // 'app_id' => 'required|integer|min:1',
            'key' => 'required|string',
            'value' => 'required|string',
        ]);
        $data = new Data;
        $data->app_id = $app_id;
        $data->key = $request->key;
        $data->value = $request->value;
        $data->save();
        return $data;
    }
    /**
    *  @api {put} /api/{app_id}/data 修改app数据
    *  @apiName change_data
    *  @apiGroup Data
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {string} key 数据的关键词
    *  @apiParam (nullable) {string} value 数据的值
    *  @apiParamExample {json} [example]
    *  {
    *    "key": "key3_change",
    *    "value": "value3_change",
    *  }
    *  @apiSuccess {json} Data 返回修改后的数据
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "app_id": "1",
    *        "key": "key3_change"
    *        "value": "value3_change",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function change(Request $request, $app_id) {
        $this->validate($request, [
            // 'app_id' => 'required|integer|min:1',
            'data_id' => 'required|integer|min:1',
            'key' => 'required|string',
            'value' => 'required|string',
        ]);
        $data = Data::find($request['data_id']);
        $data->key = $request->key;
        $data->value = $request->value;
        $data->save();
        return $data;
    }
    /**
    *  @api {put} /api/{app_id}/data 删除app数据
    *  @apiName delete_data
    *  @apiGroup Data
    *  @apiVersion v1.0.0
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
            // 'app_id' => 'required|integer|min:1',
            'data_id' => 'required|integer|min:1',
        ]);
        $data = Data::find($request->data_id);
        $data->delete();
        return [];
    }
}
<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AppController extends Controller {
    /**
    *  @api {get} /api/applist 获取app列表
    *  @apiName show_app
    *  @apiGroup App
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {string="false", "true"} want_deleted 是否获取被软删除的app
    *  @apiParamExample {json} [example]
    *  {
    *    "want_deleted" = "false",
    *  }
    *  @apiSuccess {json} App 返回所有的app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "user_id": "1",
    *        "name": "name1",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }，
    *       {
    *        "id": "2",
    *        "user_id": "1",
    *        "name": "name2",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request) {
        $this->validate($request, [
            'want_deleted' => 'nullable|string|in:true,false',
        ]);
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $apps = App::all();
        }
        else {
            $apps = App::withTrashed()->get();
        }
        return $apps;
    }
    /**
    *  @api {post} /api/addapp 添加新的app
    *  @apiName add_app
    *  @apiGroup App
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} name App的名字
    *  @apiParamExample {json} [example]
    *  {
    *    "name": "name3",
    *  }
    *  @apiSuccess {json} App 返回新增app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "user_id": "1",
    *        "name": "name3",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $app = new App;
        $app->user_id = 1;
        $app->name = $request->name;
        $app->save();
        return $app;
    }
    /**
    *  @api {delete} /api/{app_id}/deleteapp 软删除指定app
    *  @apiName delete_app
    *  @apiGroup App
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} app_id App的id
    *  @apiParamExample {json} [example]
    *  {
    *    "app_id": "3",
    *  }
    *  @apiSuccess {json} App 返回空
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       []
    */
    public function delete(Request $request, $app_id) {
        $this->validate($request, [
            'app_id' => 'required|integer|min:1',
        ]);
        $app = App::find($request->app_id);
        $app->delete();
        return [];
    }
    /**
    *  @api {put} /api/{app_id}/readapp 恢复指定的app
    *  @apiName readd_app
    *  @apiGroup App
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} app_id App的id
    *  @apiParamExample {json} [example]
    *  {
    *    "app_id": "3",
    *  }
    *  @apiSuccess {json} App 返回恢复的app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "user_id": "1",
    *        "name": "name3",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function read(Request $request, $app_id) {
        $this->validate($request, [
            'app_id' => 'required|integer|min:1',
        ]);
        $app = App::onlyTrashed()->find($request->app_id);
        $app->restore();
        return $app;
    }

    public function showadmin(Request $request, $user_id) {
        dd($request);

    }
    public function showdetail(Request $request, $app_id) {
        dd($request);
    }
}
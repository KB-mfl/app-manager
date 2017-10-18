<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use Validator;

class AppController extends Controller {
    /**
    *  @api {get} /api/app 获取所有app列表(不包括被删除)
    *  @apiName show_app
    *  @apiGroup App
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {null} null 无参数
    *  @apiParamExample {json} [example]
    *  {
    *
    *  }
    *  @apiSuccess {json} App 返回所有的app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "name": "name1",
    *        "alias": "short-name1",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }，
    *       {
    *        "id": "2",
    *        "name": "name2",
    *        "alias": "short-name2",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request) {
        $apps = App::all();
//        dd($apps);
        foreach($apps as $key => $app) {
            $response[$key] = [
                'id' => $app->id,
                'name' => $app->name,
                'alias' => $app->alias,
                'deteled_at' => null,
                'updated_at' => $app->updated_at->timestamp,
                'created_at' => $app->created_at->timestamp,
            ];
        }
        return $response;
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
            'alias' => 'required|string',
        ]);
        $app = new App;
        $app->user_id = $request->now_user->id;
        $app->name = $request->name;
        $app->alias = $request->alias;
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
    public function delete(Request $request) {
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
    public function restore(Request $request, $app_id) {
        $this->validate($request, [
            'app_id' => 'required|integer|min:1',
        ]);
        $app = App::onlyTrashed()->find($request->app_id);
        $app->restore();
        return $app;
    }
    /**
     *  @api {get} /api/user/{user_id}/app 获取自己发布的app列表
     *  @apiName show user's app
     *  @apiGroup App
     *  @apiVersion v1.0.0
     *  @apiParam (Nullable) {boolean=true, false} want_deleted 是否查看被删除的App
     *  @apiParamExample {json} [example]
     *  {
     *      want_deleted: true,
     *  }
     *  @apiSuccess {json} App 返回所有的app信息
     *  @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
     *       [{
     *        "id": "1",
     *        "name": "name1",
     *        "alias": "short-name1",
     *        "deleted_at": "2017-08-21 16:00",
     *        "updated_at": "2017-08-21 16:00",
     *        "created_at": "2017-08-21 16:00",
     *       }，
     *       {
     *        "id": "2",
     *        "name": "name2",
     *        "alias": "short-name2",
     *        "deleted_at": null,
     *        "updated_at": "2017-08-21 16:00",
     *        "created_at": "2017-08-21 16:00",
     *       }]
     */
    public function showadmin(Request $request, $user_id) {
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $apps = App::where('user_id', '=', $user_id)->get();
        } else {
            $apps = App::withTrashed()->where('user_id', '=', $user_id)->get();
        }
        return $apps;
    }
    public function showdetail(Request $request, $app_id) {
        dd($request);
    }
}
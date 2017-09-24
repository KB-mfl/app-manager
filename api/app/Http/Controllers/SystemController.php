<?php

namespace App\Http\Controllers;

use App\App;
use App\System;
use App\Version;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
    *  @api {get} /api/{app_id}/system 获得指定 app 的系统列表
    *  @apiName system_list
    *  @apiGroup System
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {string="false", "true"} want_deleted 是否获取被软删除的系统
    *  @apiParamExample {json} [example]
    *  {
    *    "want_deleted" = "false",
    *  }
    *  @apiSuccess {json} System 返回系统信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      [{
    *        "id": "1",
    *        "app_id": "1",
    *        "identifacation": "cn.xxx.xxx.cn.example",
    *        "logo_url": "example_jpeg",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "add_id": "1",
    *        "identifacation": "cn.xxx.xxx.cn.example2",
    *        "logo_url": "example_jpeg",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request, $app_id) {
        $this->validate($request, [
            'want_deleted' => 'nullable|string|in:true,false',
        ]);
        $app = App::withTrashed()->find($app_id);
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $system = $app->system()->get();
        }
        else {
            $system = System::withTrashed()->where('app_id', '=', $app_id)->get();
        }
        foreach($system as $s) {
            $s->logo_url = str_replace("public/imgs/", "", $s->logo_url);
            $s->logo_url = str_replace(".", '_',$s->logo_url);
        }
        return $system;
    }
    /**
    *  @api {post} /api/{app_id}/system 为指定 app 添加新系统
    *  @apiName add_system
    *  @apiGroup System
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} system 系统名称
    *  @apiParam (must) {file} file 对应的logo图片
    *  @apiParamExample {json} [example]
    *  {
    *    "system" = "Android"，
    *    "file" = new image,
    *  }
    *  @apiSuccess {json} System 返回新系统信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "1",
    *        "app_id": "1",
    *        "identifacation": "cn.xxx.xxx.cn.example",
    *        "logo_url": "example_jpeg",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            'file' => 'required|image',
            'system' => 'required|string|in:IOS,Android',
            'identification' => 'required|string',
            'download_url' => 'required_if:system,IOS|string|regex:/^https?:\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/',
        ]);
        $system = new System;
        $system->app_id = $app_id;
        $system->system = $request->system;
        $system->identification = $request->identification;
        $path = $request->file('file')->store('public/imgs');
        $system->logo_url = $path;
        $system->save();
        if($request->system === 'IOS') {
            $version = new Version;
            $version->build = 0;
            $version->version = 'v1.0.0';
            $version->file_url = $request->download_url;
            $system->version()->save($version);
        }
        return $system;
    }
    /**
    *  @api {delete} /api/{app_id}/system 删除指定系统
    *  @apiName delete_system
    *  @apiGroup System
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} system_id 要删除的系统id
    *  @apiParamExample {json} [example]
    *  {
    *    "system_id" = "3",
    *  }
    *  @apiSuccess {json} System 返回空
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       []
    */
    public function delete(Request $request, $app_id) {
        $this->validate($request, [
            'system_id' => 'required|integer|min:1',
        ]);
        $system = System::find($request->system_id);
        $system->delete();
        return [];
    }
    /**
    *  @api {put} /api/{app_id}/system 恢复指定系统
    *  @apiName restore_system
    *  @apiGroup System
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} system_id 要恢复的系统id
    *  @apiParamExample {json} [example]
    *  {
    *    "system_id" = "3",
    *  }
    *  @apiSuccess {json} System 返回恢复的系统信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "1",
    *        "app_id": "1",
    *        "identifacation": "cn.xxx.xxx.cn.example",
    *        "logo_url": "example_jpeg",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function restore(Request $request, $app_id) {
        $this->validate($request, [
            'system_id' => 'required|integer|min:1',
        ]);
        $system = System::onlyTrashed()->find($request->system_id);
        $system->restore();
        return $system;
    }
}

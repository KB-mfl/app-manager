<?php

namespace App\Http\Controllers;

use App\Version;
use App\System;
use App\App;
use Illuminate\Http\Request;

use Ramsey\Uuid\Uuid;

class VersionController extends Controller
{
    /**
    *  @api {get} /api/app/{app_id}/version 获取安卓版本列表
    *  @apiName version_list
    *  @apiGroup Version
    *  @apiVersion v2.0.0
    *  @apiParam (Nullable) {string="true", "false"} want_deleted 是否获取被软删除的安卓版本
    *  @apiParam (Nullable) {integer} limit 返回最新的几个版本，默认全返回
    *  @apiParamExample {json} [example]
    *  {
    *    "want_deleted" = "true",
    *  }
    *  @apiParamExample {json} [example2]
    *  {
    *    "want_deleted" = "false",
    *    "limit": 10,
    *  }
    *  @apiSuccess {json} Version 返回版本信息列表
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      [{
    *        "id": "1",
    *        "app_id": 1,
    *        "build": "1",
    *        "log": "update log",
    *        "file_url": "app/example.apk",
    *        "size": 18045982,
    *        "description": "description of the version",
    *        "from": null,
    *        "version": "v1.0.1",
    *        "deleted_at"："2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "app_id": 1,
    *        "build": "2",
    *        "log": "update log 2",
    *        "file_url": "app/example2.apk",
    *        "size": 18635952,
    *        "description": "description of the version",
    *        "from": "v1.0.1",
    *        "version": "v2.0.1",
    *        "deleted_at"： null,
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request, $app_id) {
        $this->validate($request, [
            'want_deleted' => 'nullable|string|in:true,false',
            'limit' => 'nullable|integer|min:1',
        ]);
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $versions = Version::where('app_id', '=', $app_id)->take($request->limit)->get();
        }
        else {
            $versions = Version::withTrashed()->where('app_id', '=', $app_id)->take($request->limit)->get();
        }
        $response = [];
        foreach($versions as $key => $version) {
            if($version->deleted_at === null) $deltime = null;
            else $deltime = strtotime($version->deleted_at);
            $response[$key] = [
                'id' => $version->id,
                'apk' => $version->apk,
                'version' => $version->version,
                'build' => $version->build,
                'app_id' => $app_id,
                'log' => $version->log,
                'description' => $version->description,
                'size' => $version->size,
                'from' => $version->from,
                'deleted_at' => $deltime,
                'created_at' => $version->created_at->timestamp,
            ];
        }
        return $response;
    }

    /**
    *  @api {post} /api/app/{app_id}/version 添加新版本
    *  @apiName add_version
    *  @apiGroup Version
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {file} file 上传的app安装文件
    *  @apiParam (MUST) {string} version 自定义的版本号
    *  @apiParam (MUST) {string} log 更新日志
    *  @apiParam (MUST) {string} description 版本描述
    *  @apiParamExample {json} [example]
    *  {
    *    "log": "update log",
    *    "description": "this is version description",
    *    "file": my_new_app,
    *    "version": "v1.0.5",
    *  }
    *  @apiSuccess {json} Version 返回新增版本信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "app_id": "1",
    *        "id": "1",
    *        "build": "3",
    *        "apk": "app/example.zip",
    *        "version": "v1.0.1",
    *        "log": "update log",
    *        "description": "this is version description",
    *        "size": 3957392,
    *        "from": "v1.0.0",
    *        "deleted_at"： null,
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            'file' => 'required|file',//|mimes:apk',//|mimetypes:application/vnd.android.package-archive',
            'version' => 'required|string',
            'log' => 'required|string',
            'description' => 'required|string',
        ]);
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        $now = 0;
        foreach($app->version as $ver) {
            if($ver->build > $now) {
                $now = $ver->build;
            }
        }
        $extension = $request->file('file')->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('public/apps', Uuid::uuid4()->toString(). '.'. $extension);
        $version = new Version;
        $version->log = $request->log;
        $version->description = $request->description;
        $version->app_id = $app_id;
        $version->build = $now + 1;
        $version->apk = $path;
        $version->version = $request->version;
        $version->save();
        $version->size = filesize(realpath(base_path('storage/app')).'/'.$version->apk);
        $from = null;
        $last = Version::withTrashed()->where('app_id', '=', $app_id)->where('build', '=', $version->build - 1)->first();
        if($last !== null) $from = $last->version;
        $version->from = $from;
        $response = [
            'id' => $version->id,
            'apk' => $version->apk,
            'version' => $version->version,
            'build' => $version->build,
            'app_id' => $app_id,
            'log' => $version->log,
            'description' => $version->description,
            'size' => $version->size,
            'from' => $version->from,
            'deleted_at' => null,
            'created_at' => $version->created_at->timestamp,
        ];
        return $response;
    }
    /**
    *  @api {delete} /api/app/{app_id}/version 删除指定版本
    *  @apiName delete_version
    *  @apiGroup Version
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {integer} version_id 要删除的版本id
    *
    *  @apiParamExample {json} [example]
    *  {
    *    "version_id": "1",
    *  }
    *  @apiSuccess {json} Version 返回空
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      []
    */
    public function delete(Request $request, $app_id) {
        $this->validate($request, [
            'version_id' => 'required|integer|min:1',
        ]);
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        $version = Version::withTrashed()->find($request->version_id);
        if($version === null) abort(404);
        if($version->deleted_at === null) $version->delete();
        return [];
    }
    /**
    *  @api {put} /api/app/{app_id}/version 恢复指定版本
    *  @apiName restore_version
    *  @apiGroup Version
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {integer} version_id 版本id
    *
    *  @apiParamExample {json} [example]
    *  {
    *    "version_id": "1",
    *  }
    *  @apiSuccess {json} Version 返回恢复的版本信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "app_id": "1",
    *        "id": "1",
    *        "build": "1",
    *        "log": "update log",
    *        "description": "description of the version",
    *        "size": 8264723,
    *        "from": null,
    *        "apk": "app/example.apk",
    *        "version": "v1.0.1",
    *        "deleted_at"： null,
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function restore(Request $request, $app_id) {
        $this->validate($request, [
            'version_id' => 'required|integer|min:1',
        ]);
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        $version = Version::withTrashed()->find($request->version_id);
        if($version === null) abort(404);
        if($version->deleted_at !== null) $version->restore();
        $response = [
            'id' => $version->id,
            'apk' => $version->apk,
            'version' => $version->version,
            'build' => $version->build,
            'app_id' => $app_id,
            'log' => $version->log,
            'description' => $version->description,
            'size' => $version->size,
            'from' => $version->from,
            'created_at' => $version->created_at->timestamp,
            'deleted_at' => null,
        ];
        return $response;
    }
    /*
        不更新
    */
    /**
    *  @api {get} /api/version 根据短链接获取最新版本
    *  @apiName version_list_by_alias
    *  @apiGroup Version
    *  @apiVersion v1.0.0
    *  @apiParam (MUST) {string} app_name app的名字
    *  @apiParam (MUST) {string="IOS", "Android"} system_name system的名字
    *  @apiParamExample {json} [example]
    *  {
    *    "app_name" = "example_app",
    *    "system_name" = "example_system",
    *  }
    *  @apiSuccess {json} version 返回最新版本的信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "logo_url": "example_jpeg",
    *        "version":
    *        {
    *           "app_id": "1",
    *           "id": "1",
    *           "build": "3",
    *           "apk": "app/example.zip",
    *           "version": "v1.0.1",
    *           "created_at": "2017-08-21 16:00",
    *        }
    *      }
    */
    public function seleteByName(Request $request) {
        $this->validate($request, [
            'app_name' => 'required|string',
            'system_name' => 'required|string|in:IOS,Android',
        ]);
        $app = App::where('name', '=', $request->app_name)->first();
        if(! $app) abort(404);
        $system = System::where('app_id', '=', $app->id)->where('system', '=', $request->system_name)->first();
        if(! $system) abort(404);
        
        if($system->system === 'IOS') $version = Version::where('system_id', '=', $system->id)->where('build', '=', 0)->first();
        else $version = $system->version()->orderBy('build', 'desc')->first();
        $path = $system->logo_url;
        $path = str_replace("public/imgs/", "", $path);
        $path = str_replace(".", '_',$path);
        $test = $app->system()->where('system', '=', 'IOS')->get()->where('build', '=', 0)->first();
        $has_IOS = !(! $test);
        $ts = $app->system()->where('system', '=', 'Android')->first();
        if($ts !== null) {
            $test = $ts->version()->orderBy('build', 'desc')->first();
            $has_Android = !(! $test);
        }
        else $has_Android = false;
        if(! $version) {
            return response([
                'app_name' => $app->name,
                'logo_url' => $path,
                'has_IOS' => $has_IOS,
                'has_Android' => $has_Android,
            ]);
        }
        return response([
            'app_name' => $app->name,
            'logo_url' => $path,
            'version' => $version,
            'has_IOS' => $has_IOS,
            'has_Android' => $has_Android,
        ]);
    }
}

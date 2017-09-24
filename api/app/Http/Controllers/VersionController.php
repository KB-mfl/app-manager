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
    *  @api {get} /api/{system_id}/version 获取版本列表
    *  @apiName version_list
    *  @apiGroup Version
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {string="true", "false"} want_deleted 是否获取被软删除的版本
    *  @apiParamExample {json} [example]
    *  {
    *    "want_deleted" = "false",
    *  }
    *  @apiSuccess {json} Version 返回版本信息列表
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      [{
    *        "system_id": "1",
    *        "id": "1",
    *        "build": "9",
    *        "file_url": "app/example.zip",
    *        "version": "v1.0.1",
    *        "deleted_at"： null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "system_id": "1",
    *        "id": "2",
    *        "build": "3",
    *        "file_url": "app/example2.zip",
    *        "version": "v2.0.1",
    *        "deleted_at"： null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request, $system_id) {
        $this->validate($request, [
            'want_deleted' => 'nullable|string|in:true,false',
        ]);
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $versions = Version::where('system_id', '=', $system_id)->take($request->limit)->get();
        }
        else {
            $versions = Version::withTrashed()->where('system_id', '=', $system_id)->take($request->limit)->get();
        }
        return $versions;
    }

    /**
    *  @api {post} /api/{system_id}/version 添加新版本
    *  @apiName add_version
    *  @apiGroup Version
    *  @apiVersion v1.0.0
    *  @apiParam (must) {file} file 上传的app安装文件
    *  @apiParam (must) {string} version 自定义的版本号
    *
    *  @apiParamExample {json} [example]
    *  {
    *    "file": my_new_app,
    *    "version": "v1.0.5",
    *  }
    *  @apiSuccess {json} Version 返回新增版本信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "system_id": "1",
    *        "id": "1",
    *        "build": "9",
    *        "file_url": "app/example.zip",
    *        "version": "v1.0.1",
    *        "deleted_at"： null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $system_id) {
        $this->validate($request, [
            'file' => 'required|file',//|mimes:apk',//|mimetypes:application/vnd.android.package-archive',
            'version' => 'required|string',
        ]);
        $system = System::withTrashed()->find($system_id);
        $now = 0;
        foreach($system->version()->get() as $ver) {
            if($ver->build > $now) {
                $now = $ver->build;
            }
        }
        $extension = $request->file('file')->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('public/apps', Uuid::uuid4()->toString(). '.'. $extension);
        $version = new Version;
        $version->system_id = $system_id;
        $version->build = $now + 1;
        $version->file_url = $path;
        $version->version = $request->version;
        $version->save();
        return $version;
    }
    /**
    *  @api {delete} /api/{system_id}/version 删除指定版本
    *  @apiName delete_version
    *  @apiGroup Version
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} version_id 要删除的版本id
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
    public function delete(Request $request, $system_id) {
        $this->validate($request, [
            'version_id' => 'required|integer|min:1',
        ]);
        $version = Version::find($request->version_id);
        $version->delete();
        return [];
    }
    /**
    *  @api {put} /api/{system_id}/version 恢复指定版本
    *  @apiName restore_version
    *  @apiGroup Version
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} version_id 版本id
    *
    *  @apiParamExample {json} [example]
    *  {
    *    "version_id": "1",
    *  }
    *  @apiSuccess {json} Version 返回恢复的版本信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "system_id": "1",
    *        "id": "1",
    *        "build": "9",
    *        "file_url": "app/example.zip",
    *        "version": "v1.0.1",
    *        "deleted_at"： null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function restore(Request $request, $system_id) {
        $this->validate($request, [
            'version_id' => 'required|integer|min:1',
        ]);
        $version = Version::onlyTrashed()->find($request->version_id);
        $version->restore();
        return $version;
    }
    /**
    *  @api {get} /api/version 根据名字获取版本列表
    *  @apiName version_list_by_name
    *  @apiGroup Version
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} app_name app的名字
    *  @apiParam (must) {string} system_name system的名字
    *  @apiParamExample {json} [example]
    *  {
    *    "app_name" = "example_app",
    *    "system_name" = "example_system",
    *  }
    *  @apiSuccess {string} logo_url 返回logo的名字
    *  @apiSuccess {array} version 返回最新版本的信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {"logo_url": "example_jpeg",
    *       "version":
    *       {
    *        "system_id": "1",
    *        "id": "1",
    *        "build": "9",
    *        "file_url": "app/example.zip",
    *        "version": "v1.0.1",
    *        "deleted_at"： null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
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

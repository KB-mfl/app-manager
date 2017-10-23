<?php

namespace App\Http\Controllers;

use App\Android;
use App\App;
use App\Ios;
use Illuminate\Http\Request;

class AppController extends Controller {
    /**
    *  @api {get} /api/app 获取所有app列表(不包括被删除)
    *  @apiName show_app
    *  @apiGroup App
    *  @apiVersion v2.0.0
    *  @apiParam (null) {null} null 无参数
    *  @apiParamExample {json} [example]
    *  {
    *
    *  }
    *  @apiSuccess {json} App 返回所有未删除的app信息
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
        $response = [];
        foreach($apps as $key => $app) {
            $response[$key] = [
                'id' => $app->id,
                'name' => $app->name,
                'alias' => $app->alias,
                'deleted_at' => null,
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
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {string} name App的名字
    *  @apiParam (MUST) {string} alias App的短链接
    *  @apiParamExample {json} [example]
    *  {
    *    "name": "name3",
    *    "alias": "short-name3"
    *  }
    *  @apiSuccess {json} App 返回新增app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "alias": "short-name3",
    *        "name": "name3",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'alias' => 'required|string|unique:app,alias',
        ]);
        $app = new App;
        $app->user_id = $request->now_user->id;
        $app->name = $request->name;
        $app->alias = $request->alias;
        $app->save();
        $response = [
            'id' => $app->id,
            'name' => $app->name,
            'alias' => $app->alias,
            'deleted_at' => null,
            'updated_at' => $app->updated_at->timestamp,
            'created_at' => $app->created_at->timestamp,
        ];
        return $response;
    }
    /**
    *  @api {delete} /api/app/delete 软删除指定app
    *  @apiName delete_app
    *  @apiGroup App
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {integer} app_id App的id
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
        $app = App::withTrashed()->find($request->app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        if($app->deleted_at === null) $app->delete();
        return [];
    }
    /**
    *  @api {put} /api/app/restore 恢复指定的app
    *  @apiName restore_app
    *  @apiGroup App
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {integer} app_id App的id
    *  @apiParamExample {json} [example]
    *  {
    *    "app_id": "3",
    *  }
    *  @apiSuccess {json} App 返回恢复的app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "name": "name3",
    *        "alias": "short-name3",
    *        "deleted_at": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function restore(Request $request) {
        $this->validate($request, [
            'app_id' => 'required|integer|min:1',
        ]);
        $app = App::withTrashed()->find($request->app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        if($app->deleted_at !== null) $app->restore();
        $response = [
            'id' => $app->id,
            'name' => $app->name,
            'alias' => $app->alias,
            'deleted_at' => null,
            'updated_at' => $app->updated_at->timestamp,
            'created_at' => $app->created_at->timestamp,
        ];
        return $response;
    }
    /**
     *  @api {get} /api/user/{user_id}/app 获取自己发布的app列表
     *  @apiName show user's app
     *  @apiGroup App
     *  @apiVersion v2.0.0
     *  @apiParam (Nullable) {boolean=true, false} want_deleted 是否查看被删除的App
     *  @apiParamExample {json} [example]
     *  {
     *      want_deleted: true,
     *  }
     *  @apiSuccess {json} App 返回当前用户管理的所有App信息
     *  @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
     *       [{
     *        "id": "1",
     *        "user_id": "1",
     *        "name": "name1",
     *        "alias": "short-name1",
     *        "deleted_at": "2017-08-21 16:00",
     *        "updated_at": "2017-08-21 16:00",
     *        "created_at": "2017-08-21 16:00",
     *       }，
     *       {
     *        "id": "2",
     *        "user_id": "1",
     *        "name": "name2",
     *        "alias": "short-name2",
     *        "deleted_at": null,
     *        "updated_at": "2017-08-21 16:00",
     *        "created_at": "2017-08-21 16:00",
     *       }]
     */
    public function showadmin(Request $request, $user_id) {
        $this->validate($request, [
            'want_deleted' => 'nullable',
        ]);
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            if($user_id === 1) $apps = App::all();
            else $apps = App::where('user_id', '=', $user_id)->get();
        } else {
            if($user_id === 1) $apps = App::withTranshed()->all();
            else $apps = App::withTrashed()->where('user_id', '=', $user_id)->get();
        }
        $response = [];
        foreach($apps as $key => $app) {
            if($app->deleted_at === null) $deltime = null;
            else $deltime = strtotime($app->deleted_at);
            $response[$key] = [
                'id' => $app->id,
                'user_id' => $app->user_id,
                'name' => $app->name,
                'alias' => $app->alias,
                'deleted_at' => $deltime,
                'updated_at' => $app->updated_at->timestamp,
                'created_at' => $app->created_at->timestamp,
            ];
        }
        return $response;
    }
    /**
     *  @api {get} /api/app/{app_id} 获取指定app的详细信息
     *  @apiName show app's detail
     *  @apiGroup App
     *  @apiVersion v2.0.0
     *  @apiParam (Nullable) {boolean=true, false} want_deleted 是否查看被删除的系统
     *  @apiParamExample {json} [example]
     *  {
     *      want_deleted: true,
     *  }
     *  @apiSuccess {json} App 返回指定App的信息
     *  @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
     *       {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "xxxx",
     *          "alias": "xx",
     *          "deleted_at": "2017-08-21 16:00",
     *          "updated_at": "2017-08-21 16:00",
     *          "created_at": "2017-08-21 16:00",
     *          "android":
     *          {
     *              "id": 1,
     *              "logo": "xxxxxx_jpg",
     *              "identification": "com.xxx.xxxx.xx.cn",
     *              "deleted_at": "2017-08-21 16:00",
     *              "updated_at": "2017-08-21 16:00",
     *              "created_at": "2017-08-21 16:00",
     *          },
     *          "ios":
     *          {
     *              "id": 1,
     *              "itunes_url": "http://itunes.apple.com/xxx/idxxxx"
     *              "alias": "short_name_ios",
     *              "logo": "http://xxxxxx2.jpg",
     *              "description": "app's description",
     *              "identification": "com.xxx.xxxx.xx.cn",
     *              "version": "v1.0.1",
     *              "log": "update_log_info",
     *              "size": 1235532,
     *              "price": 0.00,
     *              "coin": "USD",
     *              "author": "xxx",
     *              "deleted_at": "2017-08-21 16:00",
     *              "updated_at": "2017-08-21 16:00",
     *              "created_at": "2017-08-21 16:00",
     *          }
     */
    public function showdetail(Request $request, $app_id) {
        $this->validate($request, [
            'want_deleted' => 'nullable',
        ]);
        $app = App::withTrashed()->find($app_id);
        if(! $app) abort(404);
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $ios = $app->ios;
            $android = $app->android;
        } else {
            $ios = Ios::withTrashed()->where('app_id', '=', $app_id)->first();
            $android = Android::withTrashed()->where('app_id', '=', $app_id)->first();
        }
        if($app->deleted_at === null) $deltime = null;
        else $deltime = strtotime($app->deleted_at);
        $response = [
            'id' => $app->id,
            'user_id' => $app->user_id,
            'name' => $app->name,
            'alias' => $app->alias,
            'deleted_at' => $deltime,
            'updated_at' => $app->updated_at->timestamp,
            'created_at' => $app->created_at->timestamp,
        ];
        if($ios !== null) {
            $pattern = '/id[0-9]*/';
            $pattern2 = '/[0-9]*/';
            preg_match_all($pattern, $ios->itunes, $arr);
            preg_match_all($pattern2, $arr[0][0], $arr2);
            $itunes_id = $arr2[0][2];
            $url = 'https://itunes.apple.com/lookup?id=' . $itunes_id;
            $content = file_get_contents($url);
            $json = json_decode($content);
            $ios_info = $json->results[0];
            $itunes_id = isset($ios_info->trackId) ? $ios_info->trackId : null;
            $logo = isset($ios_info->artworkUrl512) ? $ios_info->artworkUrl512 : null;
            $description = isset($ios_info->description) ? $ios_info->description : null;
            $alias = isset($ios_info->trackCensoredName) ? $ios_info->trackCensoredName : null;
            $identification = isset($ios_info->bundleId) ? $ios_info->bundleId : null;
            $version = isset($ios_info->version) ? $ios_info->version : null;
            $size = isset($ios_info->fileSizeBytes) ? $ios_info->fileSizeBytes : null;
            $price = isset($ios_info->price) ? $ios_info->price : null;
            $coin = isset($ios_info->currency) ? $ios_info->currency : null;
            $author = isset($ios_info->artistName) ? $ios_info->artistName : null;
            $releaseDate = isset($ios_info->releaseDate) ? strtotime($ios_info->releaseDate) : null;
            $currentVersionReleaseDate = isset($ios_info->currentVersionReleaseDate) ? strtotime($ios_info->currentVersionReleaseDate) : null;
            $log = isset($ios_info->releaseNotes) ? $ios_info->releaseNotes : null;
            /**/
            $response['ios'] = [
                'id' => $ios->id,
                'itunes_url' => $ios->itunes,
                'itunes_id' => $itunes_id,
                'logo' => $logo,
                'alias' => $alias,
                'description' => $description,
                'identification' => $identification,
                'version' => $version,
                'log' => $log,
                'size' => $size,
                'price' => $price,
                'coin' => $coin,
                'author' => $author,
                'created_at' => $releaseDate,
                'updated_at' => $currentVersionReleaseDate,
                'deleted_at' => $ios->deleted_at === null ? null : strtotime($ios->deleted_at),
            ];
        } else {
            $response['ios'] = null;
        }
        if($android !== null) {
            $android->logo_url = str_replace("public/imgs/", "", $android->logo_url);
            $android->logo_url = str_replace(".", '_',$android->logo_url);
            $response['android'] = [
                'id' => $android->id,
                'identification' => $android->inentification,
                'logo' => $android->logo_url,
                'created_at' => $android->created_at->timestamp,
                'updated_at' => $android->updated_at->timestamp,
                'deleted_at' => $android->deleted_at === null ? null : strtotime($android->deleted_at),
            ];
        } else {
            $response['android'] = null;
        }
        return $response;
    }
}
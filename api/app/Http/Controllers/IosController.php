<?php

namespace App\Http\Controllers;

use App\Ios;
use App\App;
use Illuminate\Http\Request;

class IosController extends Controller
{
    /**
     *  @api {post} /api/app/{app_id}/ios 上传iOS版本资料
     *  @apiName new iOS
     *  @apiGroup Ios
     *  @apiVersion v2.0.0
     *  @apiParam (MUST) {string} itunes iTunes连接URL
     *  @apiParamExample {json} [example]
     *  {
     *      "itunes": "https://itunes.apple.com/us/app/xxxxx/idxxxxxxx",
     *  }
     *  @apiSuccess {json} iOS 返回添加的iOS信息
     *  @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
     *       {
     *        "id": "1",
     *        "app_id": "1",
     *        "logo_url": "http://xxxxxx.jpg",
     *        "identification": "com.xxx.xxx.xx.cn",
     *        "deleted_at": "2017-08-21 16:00",
     *        "updated_at": "2017-08-21 16:00",
     *        "created_at": "2017-08-21 16:00",
     *       }
     */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            'itunes' => [
                'required',
                'string',
            ],
        ]);
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        $ios = null;
        $ios = Ios::withTrashed()->where('app_id', '=', $app_id)->first();
        if($ios !== null) abort(444);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        $ios = new Ios;
        $pattern = '/id[0-9]*/';
        $pattern2 = '/[0-9]*/';
        preg_match_all($pattern, $request->itunes, $arr);
        preg_match_all($pattern2, $arr[0][0], $arr2);
        $itunes_id = $arr2[0][2];
        $ios->itunes = $request->itunes;
        $ios->app_id = $app_id;
        $ios->save();
        $url = 'https://itunes.apple.com/lookup?id='.$itunes_id;
        $content = file_get_contents($url);
        $json = json_decode($content);
        $app = $json->results[0];
        $logo = isset($app->artworkUrl512) ? $app->artworkUrl512 : null;
        $identification = isset($app->bundleId) ? $app->bundleId : null;
        $releaseDate = isset($app->releaseDate) ? strtotime($app->releaseDate) : null;
        $currentVersionReleaseDate = isset($app->currentVersionReleaseDate) ? strtotime($app->currentVersionReleaseDate) : null;
        $response = [
            'id' => $ios->id,
            'app_id' => $ios->app_id,
            'logo_url' => $logo,
            'identification' => $identification,
            'created_at' => $releaseDate,
            'updated_at' => $currentVersionReleaseDate,
            'deleted_at' => null,
        ];
        return $response;
    }
    /**
     *  @api {delete} /api/app/{app_id}/ios 删除iOS版本
     *  @apiName delete iOS
     *  @apiGroup Ios
     *  @apiVersion v2.0.0
     *  @apiParam (null) {null} null 无参数
     *  @apiParamExample {json} [example]
     *  {
     *
     *  }
     *  @apiSuccess {json} iOS 返回添加的iOS信息
     *  @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
     *       []
     */
    public function delete(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        $ios = Ios::withTrashed()->where('app_id', '=', $app_id)->first();
        if($ios === null) abort(404);
        if($ios->deleted_at === null) $ios->delete();
        return [];
    }
    /**
     *  @api {put} /api/app/{app_id}/ios 恢复iOS版本
     *  @apiName restore iOS
     *  @apiGroup Ios
     *  @apiVersion v2.0.0
     *  @apiParam (null) {null} null 无参数
     *  @apiParamExample {json} [example]
     *  {
     *
     *  }
     *  @apiSuccess {json} iOS 返回添加的iOS信息
     *  @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
     *       {
     *        "id": "1",
     *        "app_id": "1",
     *        "logo_url": "http://xxxxxx.jpg",
     *        "identification": "com.xxx.xxx.xx.cn",
     *        "deleted_at": "2017-08-21 16:00",
     *        "updated_at": "2017-08-21 16:00",
     *        "created_at": "2017-08-21 16:00",
     *       }
     */
    public function restore(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        if($app === null) abort(404);
        if($app->user_id !== $request->now_user->id && $request->now_user->id !== 1) abort(403);
        $ios = Ios::withTrashed()->where('app_id', '=', $app_id)->first();
        if($ios === null) abort(404);
        if($ios->deleted_at !== null) $ios->restore();
        $pattern = '/id[0-9]*/';
        $pattern2 = '/[0-9]*/';
        preg_match_all($pattern, $ios->itunes, $arr);
        preg_match_all($pattern2, $arr[0][0], $arr2);
        $itunes_id = $arr2[0][2];
        $url = 'https://itunes.apple.com/lookup?id='.$itunes_id;
        $content = file_get_contents($url);
        $json = json_decode($content);
        $app = $json->results[0];
        $logo = isset($app->artworkUrl512) ? $app->artworkUrl512 : null;
        $identification = isset($app->bundleId) ? $app->bundleId : null;
        $releaseDate = isset($app->releaseDate) ? strtotime($app->releaseDate) : null;
        $currentVersionReleaseDate = isset($app->currentVersionReleaseDate) ? strtotime($app->currentVersionReleaseDate) : null;
        $response = [
            'id' => $ios->id,
            'app_id' => $ios->app_id,
            'logo_url' => $logo,
            'identification' => $identification,
            'created_at' => $releaseDate,
            'updated_at' => $currentVersionReleaseDate,
            'deleted_at' => null,
        ];
        return $response;
    }
}

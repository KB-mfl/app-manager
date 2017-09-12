<?php

namespace App\Http\Controllers;

use App\Version;
use App\System;
use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {
    /**
    *  @api {get} /api/download 下载安装包
    *  @apiName download
    *  @apiGroup Download
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} version_id 想要下载的版本id
    *  @apiParamExample {json} [example]
    *  {
    *    "version_id" = "1",
    *  }
    *  @apiSuccess {json} App 返回所有的app信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *        the file you want
    */
    public function show(Request $request) {
        $version = Version::find($request->version_id);
        $system = System::find($version->system_id);
        $app = App::find($system->app_id);
        $header = [
            'Content-Type' => 'application/vnd.android.package-archive',
        ];
        return response()->download(realpath(base_path('storage/app')).'/'.$version->file_url, $app->name.'.apk', $header);
    }
}
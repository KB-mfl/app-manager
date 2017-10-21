<?php

namespace App\Http\Controllers;

use App\Android;
use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
    /**
    *  @api {post} /api/image 覆盖指定系统logo
    *  @apiName change_logo
    *  @apiGroup Image
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {file} file 新的logo图片文件
    *  @apiParam (MUST) {android_id} int 修改的安卓系统id
    *  @apiParamExample {json} [example]
    *  {
    *    "file" = my_new_logo,
    *    "android_id": 1,
    *  }
    *  @apiSuccess {string} Image 新logo保存的路径
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *         random_name.xxx
    *       }
    */
    public function store(Request $request) {
        $this->validate($request, [
            'android_id' => 'required|integer|min:1',
            'file' => 'required|image',
        ]);
        $android = Android::find($request->android_id);
        $path = $request->file('file')->store('public/imgs');
        $old_path = $android->logo_url;
        $android->logo_url = $path;
        if($old_path != null) {
            Storage::delete($old_path);
        }
        $android->save();
        $path = str_replace("public/imgs/", "", $path);
        $path = str_replace(".", '_',$path);
        return $path;
    }
    /**
    *  @api {any} /api/image/{image_name} 获取指定图片
    *  @apiName get_image
    *  @apiGroup Image
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {string} img_name 要获取的图片名字
    *  @apiParamExample {json} [example]
    *  {
    *    "img_name" = "randomname_jpeg",
    *  }
    *  @apiSuccess {file} Image 要显示的图片
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *         "file": the_image_you_want,
    *       }
    */
    public function show(Request $request, $img_name) {
        $path = $img_name;
        $path = str_replace("_", '.',$path);
        return response()->file(base_path('storage/app/public/imgs/').$path);
    }
}
<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
    /**
    *  @api {post} /api/{system_id}/image 覆盖指定系统logo
    *  @apiName change_logo
    *  @apiGroup Image
    *  @apiVersion v1.0.0
    *  @apiParam (must) {file} file 新的logo图片文件
    *  @apiParamExample {json} [example]
    *  {
    *    "file" = my_new_logo,
    *  }
    *  @apiSuccess {string} Image 新logo保存的路径
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *         image_store_path/random_name.xxx
    *       }
    */
    public function store(Request $request, $system_id) {
        $this->validate($request, [
            'system_id' => 'required|integer|min:1',
            'file' => 'required|image',
        ]);
        $system = System::find($system_id);
        $path = $request->file('file')->store('public/imgs');
        $old_path = $system->logo_url;
        $system->logo_url = $path;
        if($old_path != null) {
            Storage::delete($old_path);
        }
        $system->save();
        return $path;
    }
    /**
    *  @api {any} /api/image/{image_name} 获取指定图片
    *  @apiName get_image
    *  @apiGroup Image
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} img_name 要获取的图片名字
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
        // $this->validate($request, [
        //     
        // ]);
        $path = $img_name;
        $path = str_replace("_", '.',$path);
        return response()->file(base_path('storage/app/public/imgs/').$path);
    }
}
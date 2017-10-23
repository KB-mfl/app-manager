<?php

namespace App\Http\Controllers;

use App\FirstScreen;
use App\App;
use Illuminate\Http\Request;

class FirstScreenController extends Controller
{
    /**
    *  @api {get} /api/{app_id}/first_screen 获取首屏列表
    *  @apiName get_first_screen
    *  @apiGroup FirstScreen
    *  @apiVersion v1.0.0
    *  @apiParamExample {json} [example]
    *  {
    *  }
    *  @apiSuccess {json} FirstScreen 返回首屏列表信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "app_id": "1",
    *        "content": "first first screen",
    *        "image_url": "image_store_path/random_name.xxx",
    *        "actived": "false",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "app_id": "1",
    *        "content": "second first screen",
    *        "image_url": "image_store_path/random_name2.xxx",
    *        "actived": "false",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function show(Request $request, $app_id) {
        // $this->validate($request, [
        //     'app_id' => 'required|integer|min:1',
        // ]);
        $app = App::withTrashed()->find($app_id);
        $first_screens = $app->first_screen;
        foreach($first_screens as $fs) {
            $fs->image_url = str_replace("public/imgs/", "", $fs->image_url);
            $fs->image_url = str_replace(".", '_',$fs->image_url);
        }
        return $first_screens;
    }
    /**
    *  @api {post} /api/{app_id}/first_screen 为指定app新增首屏
    *  @apiName add_first_screen
    *  @apiGroup FirstScreen
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {file} file 首屏的图片
    *  @apiParam (must) {string} content 首屏的文字内容
    *  @apiParamExample {json} [example]
    *  {
    *    "content": "this is content",
    *    "file": my_first_screen_image,
    *  }
    *  @apiSuccess {json} FirstScreen 返回新增首屏信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "app_id": "1",
    *        "content": "this is content",
    *        "image_url": "image_store_path/random_name3.xxx",
    *        "actived": "true",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            // 'app_id' => 'required|integer|min:1',
            'file' => 'nullable|image',
            'content' => 'required|string',
        ]);
        $app = App::withTrashed()->find($app_id);
        foreach($app->first_screen as $fs) {
            $fs->actived = false;
            $fs->save();
        }
        if(isset($request['file'])) {
            $path = $request->file('file')->store('public/imgs');
        }
        else {
            $path = null;
        }
        $first_screen = new FirstScreen;
        $first_screen->actived = true;
        $first_screen->content = $request['content'];
        $first_screen->app_id = $app_id;
        $first_screen->image_url = $path;
        $first_screen->save();
        return $first_screen;
    }
    /**
    *  @api {put} /api/{app_id}/first_screen 激活指定首屏
    *  @apiName active_first_screen
    *  @apiGroup FirstScreen
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} first_screen_id 要激活的首屏id
    *  @apiParamExample {json} [example]
    *  {
    *    "first_screen_id": "3",
    *  }
    *  @apiSuccess {json} FirstScreen 返回被激活的首屏信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "app_id": "1",
    *        "content": "this is content",
    *        "image_url": "image_store_path/random_name3.xxx",
    *        "actived": "true",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function active(Request $request, $app_id) {
        $this->validate($request, [
            // 'app_id' => 'required|integer|min:1',
            'first_screen_id' => 'required|integer|min:1',
        ]);
        $app = App::withTrashed()->find($app_id);
        foreach($app->first_screen as $fs) {
            $fs->actived = false;
            $fs->save();
        }
        $first_screen = FirstScreen::find($request->first_screen_id);
        $first_screen->actived = true;
        $first_screen->save();
        return $first_screen;
    }
    /**
    *  @api {delete} /api/{app_id}/first_screen 删除指定首屏
    *  @apiName delete_first_screen
    *  @apiGroup FirstScreen
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} first_screen_id 要删除的首屏id
    *  @apiParamExample {json} [example]
    *  {
    *    "first_screen_id": "3",
    *  }
    *  @apiSuccess {json} FirstScreen 返回空
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       []
    */
    public function delete(Request $request, $app_id) {
        $this->validate($request, [
            // 'app_id' => 'required|integer|min:1',
            'first_screen_id' => 'required|integer|min:1',
        ]);
        $first_screen = FirstScreen::find($request->first_screen_id);
        $first_screen->delete();
        return [];
    }
}

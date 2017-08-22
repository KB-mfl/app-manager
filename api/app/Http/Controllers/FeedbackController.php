<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use App\App;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
    *  @api {get} /api/{app_id}/feedback 查看app反馈列表
    *  @apiName view_feedback
    *  @apiGroup Feedback
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} app_id 要查看反馈的app的id
    *  @apiParamExample {json} [example]
    *  {
    *    "app_id": "1",
    *  }
    *  @apiSuccess {json} Feedback 返回指定app的所有反馈信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "app_id": "1",
    *        "user_id": "1",
    *        "title": "title1",
    *        "content": "this is content",
    *        "feedback_id": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "app_id": "1",
    *        "user_id": "1",
    *        "title": "title2",
    *        "content": "this is content",
    *        "feedback_id": "1",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function showApp(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        $feedbacks = $app->feedback;
        foreach($feedbacks as $fb) {
            $name = $fb->user()->first()->username;
            $fb['username'] = $name;
        }
        return $feedbacks;
    }
    /**
    *  @api {get} /api/{user_id}/feedback 查看用户反馈列表
    *  @apiName user_feedback
    *  @apiGroup Feedback
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} user_id 要查看反馈的用户的id
    *  @apiParamExample {json} [example]
    *  {
    *    "user_id": "1",
    *  }
    *  @apiSuccess {json} Feedback 返回指定用户的所有反馈信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "app_id": "1",
    *        "user_id": "1",
    *        "title": "title1",
    *        "content": "this is content",
    *        "feedback_id": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "app_id": "1",
    *        "user_id": "1",
    *        "title": "title2",
    *        "content": "this is content",
    *        "feedback_id": "1",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function showUser(Request $request, $user_id) {
        $user = User::withTrashed()->find($user_id);
        $feedbacks = $user->feedback;
        foreach($feedbacks as $fb) {
            $fb['username'] = $user->username;
        }
        return $feedbacks;
    }
    /**
    *  @api {post} /api/{app_id}/feedback 添加反馈
    *  @apiName add_feedback
    *  @apiGroup Feedback
    *  @apiVersion v1.0.0
    *  @apiParam (nullable) {file} file 首屏的图片
    *  @apiParam (must) {string} content 首屏的文字内容
    *  @apiParamExample {json} [example]
    *  {
    *    "content": "this is content",
    *    "file": my_first_screen_image,
    *  }
    *  @apiSuccess {json} Feedback 返回新增首屏信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "3",
    *        "app_id": "1",
    *        "user_id": "1",
    *        "title": "title3"
    *        "content": "this is content",
    *        "feedback_id": null,
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $feedback = new Feedback;
        $feedback->app_id = $app_id;
        $user_id = User::where('username', '=', $request->username)->first()->id;
        $feedback->user_id = $user_id;
        $feedback->feedback_id = null;
        if(isset($request['feedback_id']) && $request->feedback_id !== null && $request->feedback_id !== '') {
            $feedback->feedback_id = $request->feedback_id;
        }
        $feedback->title = $request->title;
        $feedback->content = $request->content;
        $feedback->save();
        return $feedback;
    }
    private function clear(Feedback $feedback) {
        foreach($feedback->replyFrom as $fb) {
            $this->clear($fb);
        }
        $feedback->delete();
        return;
    }
    /**
    *  @api {delete} /api/{app_id}/feedback 删除反馈以及回复该反馈的反馈
    *  @apiName delete_feedback
    *  @apiGroup Feedback
    *  @apiVersion v1.0.0
    *  @apiParam (must) {integer} feedback_id 要删除的反馈id
    *  @apiParamExample {json} [example]
    *  {
    *    "feedback_id": "1",
    *  }
    *  @apiSuccess {json} Feedback 返回空
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       []
    */
    public function delete(Request $request, $app_id) {
        $feedback = Feedback::findOrFail($request->feedback_id);
        $this->clear($feedback);
        return [];
    }
}

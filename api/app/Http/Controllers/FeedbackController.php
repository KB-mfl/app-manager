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
    *  @apiVersion v2.0.0
    *  @apiParam (null) {null} null 无参数
    *  @apiParamExample {json} [example]
    *  {
    *
    *  }
    *  @apiSuccess {json} Feedback 返回指定app的所有反馈信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       [{
    *        "id": "1",
    *        "app_id": "1",
    *        "email": "example1@gmail.com",
    *        "name": "example1",
    *        "phone": "13700000000",
    *        "title": "title1",
    *        "contents": "this is content",
    *        "feedback_id": null,
    *        "created_at": "2017-08-21 16:00",
    *       },
    *       {
    *        "id": "2",
    *        "app_id": "1",
    *        "email": "example2@gmail.com",
    *        "name": "example2",
    *        "phone": "13700000001",
    *        "title": "title2",
    *        "contents": "this is content2",
    *        "feedback_id": "1",
    *        "created_at": "2017-08-21 16:00",
    *       }]
    */
    public function showApp(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        if(! $app) abort(404);
        $response = [];
        $feedbacks = $app->feedback;
        foreach($feedbacks as $key => $fb) {
            $response[$key] = [
                'id' => $fb->id,
                'app_id' => $fb->app_id,
                'email' => $fb->email,
                'name' => $fb->name,
                'phone' => $fb->phone,
                'feedback_id' => $fb->feedback_id,
                'title' => $fb->title,
                'contents' => $fb->contents,
                'created_at' => $fb->created_at->timestamp,
            ];
        }
        return $response;
    }
    /**
    *  @api {post} /api/app/{app_id}/feedback 添加反馈
    *  @apiName add_feedback
    *  @apiGroup Feedback
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {string} name 用户的名字
    *  @apiParam (MUST) {string} phone 用户的手机号
    *  @apiParam (MUST) {string} email 用户的邮箱
    *  @apiParam (MUST) {string} title 评论的标题
    *  @apiParam (MUST) {string} contents 评论的内容
    *  @apiParam (Nullable) {integer} feedback_id 回复评论的id
    *  @apiParamExample {json} [example]
    *  {
    *    "name": "Zhangsan",
    *    "phone": "13958000000",
    *    "email": "zhangsan@app.com",
    *    "title": "title1",
    *    "contents": "this is content",
    *  }
    *  @apiParamExample {json} [example2]
    *  {
    *    "name": "Zhaosi",
    *    "phone": "13458000000",
    *    "email": "zhaosi@app.com",
    *    "title": "title2",
    *    "contents": "this is content, too",
    *    "feedback_id": 1,
    *  }
    *  @apiSuccess {json} Feedback 返回新增评论信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *       {
    *        "id": "2",
    *        "app_id": "1",
    *        "name": "Zhaosi",
    *        "phone": "13458000000",
    *        "email": "zhaosi@app.com",
    *        "title": "title2"
    *        "contents": "this is content, too",
    *        "feedback_id": 1,
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function store(Request $request, $app_id) {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => [
                'required',
                'string',
                'regex:/^1(3|4|5|7|8)[0-9]{9}$/',
            ],
            'email' => 'required|email',
            'feedback_id' => 'nullable|integer|min:1',
            'title' => 'required|string',
            'contents' => 'required|string',
        ]);
        $feedback = new Feedback;
        $feedback->app_id = $app_id;
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->phone = $request->phone;
        $feedback->feedback_id = null;
        if(isset($request['feedback_id']) && $request->feedback_id !== null && $request->feedback_id !== '') {
            $temp_fb = Feedback::find($request->feedback_id);
            if($temp_fb !== null) $feedback->feedback_id = $request->feedback_id;
        }
        $feedback->title = $request->title;
        $feedback->contents = $request->contents;
        $feedback->save();
        $response = [
            'id' => $feedback->id,
            'app_id' => $app_id,
            'email' => $feedback->email,
            'name' => $feedback->name,
            'phone' => $feedback->phone,
            'feedback_id' => $feedback->feedback_id,
            'title' => $feedback->title,
            'contents' => $feedback->contents,
            'created_at' => $feedback->created_at->timestamp,
        ];
        return $response;
    }
    private function clear(Feedback $feedback = null) {
        if($feedback === null) return;
        foreach($feedback->replyFrom as $fb) {
            $this->clear($fb);
        }
        $feedback->delete();
        return;
    }
    /**
    *  @api {delete} /api/app/{app_id}/feedback 删除反馈以及回复该反馈的反馈
    *  @apiName delete_feedback
    *  @apiGroup Feedback
    *  @apiVersion v2.0.0
    *  @apiParam (MUST) {integer} feedback_id 要删除的反馈id
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
        $this->validate($request, [
            'feedback_id' => 'required|integer|min:1',
        ]);
        $feedback = Feedback::find($request->feedback_id);
        $this->clear($feedback);
        return [];
    }
}

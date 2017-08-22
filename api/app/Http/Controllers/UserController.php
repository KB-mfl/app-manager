<?php

namespace App\Http\Controllers;
//改动Auth\SessionGuard
use App\User;
use App\ApiToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{

    use AuthenticatesUsers;
    /**
    *  @api {post} /api/register 注册新用户
    *  @apiName add_new_user
    *  @apiGroup User
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} username 用户名
    *  @apiParam (must) {string} password 密码
    *  @apiParamExample {json} [example]
    *  {
    *    "username" = "example",
    *    "password" = "example",
    *  }
    *  @apiSuccess {json} User 返回用户信息
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "id": "1",
    *        "username": "example",
    *        "admin": "false",
    *        "updated_at": "2017-08-21 16:00",
    *        "created_at": "2017-08-21 16:00",
    *       }
    */
    public function register(Request $request) {
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->admin = false;
        if(isset($request['admin']) && $request->admin === 'true') {
            $user->admin = true;
        }
        $user->save();
        return $user;
    }
    /**
    *  @api {post} /api/login 用户登录
    *  @apiName user_login
    *  @apiGroup User
    *  @apiVersion v1.0.0
    *  @apiParam (must) {string} username 用户名
    *  @apiParam (must) {string} password 密码
    *  @apiParamExample {json} [example]
    *  {
    *    "username" = "example",
    *    "password" = "example",
    *  }
    *  @apiSuccess {json} User 返回登录状态和token
    *  @apiSuccessExample Success-Response:
    *    HTTP/1.1 200 OK
    *      {
    *        "status": "true",
    *        "username": "example",
    *        "apiToken": "random string",
    *       }
    */
    public function login(Request $request) {
        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            $user = Auth::user();
            $apiToken = new ApiToken();
            $apiToken->token = Uuid::uuid4()->toString();
            $apiToken->ip = $request->server('REMOTE_ADDR', null);
            $apiToken->expired_at = Carbon::now()->addMinutes(30);
            $user->apitokens()->save($apiToken);
            $flag = $user->admin ? true : false;
            return response([
                'status' => Auth::check(),
                'apiToken' => $apiToken->token,
                'username' => $user->username,
                'admin' => $flag,
            ]);
        }
        return ['status' => Auth::check(),
                'username' => $request->username,
                'apiToken' => '',
                ];

    }
}

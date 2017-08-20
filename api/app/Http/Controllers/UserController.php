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

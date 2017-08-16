<?php

namespace App\Http\Controllers;
//改动Auth\SessionGuard
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{

    use AuthenticatesUsers;

    public function register(Request $request) {
        $user = new User;
        $user->name = $request->name;
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
            'name' => $request->name,
            'password' => $request->password
        ])) {
            //return 'true';
            //return Auth::user();
            //return redirect()->route('mytest2');
            //return $request->user();
            $user = Auth::user();
            $user = $user->toArray();
            //$user->append(['status' => Auth::check()]);
            $user['status'] = Auth::check();
            //$user['sessionId'] = Session::getId();
            return $user;
            /*
            return ['status' => Auth::check(),
                    'sessionId' => Session::getId(),
                    $user,
                    ];
            return Session::getId();
            return 'true';
            */
        }
        //'sessionId' => Session::getId(),
        //return 'false';
        return ['status' => Auth::check(),
                'name' => $request->name];
    }
    /*
    public function check(Request $request) {
        return ['status' => Auth::check(),
                'session_id' => Session::getId()];
    }
    */
    /*
    public function logout(Request $request) {
        if(Auth::check()) {
            return 'true';
            Auth::logout();
        }
        return 'false';
        return [];
    }
    */
}

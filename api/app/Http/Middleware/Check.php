<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\ApiToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiToken = ApiToken::where('token', '=', $request->apiToken)->first();
        $user = User::where('username', '=', $request->username)->first();
        if(!$user || !$apiToken) abort(401);
        if($user->admin === 0) abort(403);
        if($user->id === $apiToken->user_id && $apiToken->expired_at >= Carbon::now() && $apiToken->ip === $request->server('HTTP_X_FORWARDED_FOR', $request->server('REMOTE_ADDR', null))) {
            $apiToken->expired_at = Carbon::now()->addMinutes(30);
            $apiToken->save();
            $request->now_user = $user;
            return $next($request);
        }
        //else abort(401);
    }
}

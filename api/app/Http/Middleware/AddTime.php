<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\ApiToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AddTime
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
        if(isset($request->apiToken) && isset($request->username)) {
            $apiToken = ApiToken::where('token', '=', $request->apiToken)->first();
            $user = User::where('username', '=', $request->username)->first();
            if(!$user || !$apiToken) {
                return abort(401);
            }
            else if($user->id === $apiToken->user_id && $apiToken->expired_at >= Carbon::now()) {
                $apiToken->expired_at = Carbon::now()->addMinutes(30);
                $apiToken->save();
                return $next($request);
            }
            /*
            return response([
                '1' => $user->id === $apiToken->user_id,
                '2' => $apiToken->expired_at >= Carbon::now(),
                '3' => $apiToken->ip === $request->server('REMOTE_ADDR', null),
            ]);
            */
            else return abort(401);
        }
        return abort(401);
    }
}

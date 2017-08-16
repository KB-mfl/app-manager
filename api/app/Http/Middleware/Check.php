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
        /*
        if(Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ])) {
            return $next($request);
        }
        return abort(403);
        */
        //
        $apiToken = ApiToken::where('token', '=', $request->apitoken)->first();
        $user = User::where('name', '=', $request->name)->first();
        if(!$user || !$apiToken) abort(403);
        if($user->id === $apiToken->user_id && $apiToken->expired_at >= Carbon::now()) {
            $apiToken->expired_at = Carbon::now()->addMinutes(30);
            $apiToken->save();
            return $next($request);
        }
        else abort(403);
    }
}

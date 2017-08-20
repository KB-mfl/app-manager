<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Feedback;
use App\ApiToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckFeedback
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
        $feedback = Feedback::findOrFail($request->feedback_id);
        if($user->admin === 1 || $user->id === $feedback->user_id) {
            ;
        }
        else abort(403);
        if($user->id === $apiToken->user_id && $apiToken->expired_at >= Carbon::now()) {
            $apiToken->expired_at = Carbon::now()->addMinutes(30);
            $apiToken->save();
            return $next($request);
        }
        else abort(401);
    }
}

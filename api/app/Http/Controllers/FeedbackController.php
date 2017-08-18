<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use App\App;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showApp(Request $request, $app_id) {
        $app = App::withTrashed()->find($app_id);
        $feedbacks = $app->feedback;
        foreach($feedbacks as $fb) {
            $name = $fb->user()->first()->username;
            $fb['username'] = $name;
        }
        return $feedbacks;
    }
    /*
    public function showUser(Request $request, $user_id) {
        $user = User::withTrashed()->find($user_id);
        $feedbacks = $user->feedback;
        foreach($feedbacks as $fb) {
            $fb['username'] = $user->username;
        }
        return $feedbacks;
    }
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
    public function delete(Request $request, $app_id) {
        $feedback = Feedback::findOrFail($request->feedback_id);
        $this->clear($feedback);
        return [];
    }
}

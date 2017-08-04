<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use App\App;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showApp(Request $request, $app_id) {
        $app = App::find($app_id);
        $feedbacks = $app->feedback;
        return $feedbacks;
    }
    public function showUser(Request $request, $user_id) {
        $user = User::find($user_id);
        $feedbacks = $user->feedback;
        return $feedbacks;
    }
    public function store(Request $request, $app_id) {
        $feedback = new Feedback;
        $feedback->app_id = $app_id;
        $feedback->user_id = 1;
        if(isset($request['feedback_id'])) {
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
        $feedback = Feedback::find($request->feedback_id);
        $this->clear($feedback);
        return [];
    }
}

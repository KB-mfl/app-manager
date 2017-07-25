<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
    public function store(Request $request, $app_id) {
        $app = App::find($app_id);
        $path = $request->file('img')->store('imgs');
        if($request->is_logo) {
            $old_path = $app->logo_url;
            $app->logo_url = $path;
        }
        else {
            $old_path = $app->image_url;
            $app->image_url = $path;
        }
        if($old_path != null) {
            Storage::delete($old_path);
        }
        $app->save();
        return base_path('storage/app/').$path;
    }
}
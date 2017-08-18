<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
    public function store(Request $request, $system_id) {
        $system = System::find($system_id);
        $path = $request->file('file')->store('public/imgs');
        $old_path = $system->logo_url;
        $system->logo_url = $path;
        if($old_path != null) {
            Storage::delete($old_path);
        }
        $system->save();
        return $path;
    }
    public function show(Request $request, $system_id) {
        $system = System::find($system_id);
        $path = $system->logo_url;
        return response()->file(base_path('storage/app/').$path);
    }
}
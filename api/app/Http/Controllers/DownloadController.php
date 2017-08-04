<?php

namespace App\Http\Controllers;

use App\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {
    public function show(Request $request) {
        $version = Version::find($request->version_id);
        return response()->download(base_path('storage/app/').$version->file_url);
    }
}
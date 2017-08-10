<?php

namespace App\Http\Controllers;

use App\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {
    public function show(Request $request) {
        $version = Version::find($request->version_id);
        //return base_path('storage/app/').$version->file_url;
        //return $version->file_url;
        //return asset('storage/'.$version->file_url);
        return response()->download(realpath(base_path('storage/app')).'/'.$version->file_url);
        //return response()->download(realpath(base_path('storage/app/public/')).'/'.$version->file_url, 'lalala.png', ['mimeType', 'image/png']);
    }
}
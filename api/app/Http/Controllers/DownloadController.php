<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {
    public function show(Request $request) {
        $history = History::find($request->history_id);
        return response()->download(base_path('storage/app/').$history->file_url);
    }
}
<?php

namespace App\Http\Controllers;

use App\Version;
use App\System;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function show(Request $request, $system_id) {
        if(!isset($request['want_deleted']) || $request->want_deleted === 'false') {
            $versions = Version::where('system_id', '=', $system_id)->take($request->limit)->get();
        }
        else {
            $versions = Version::withTrashed()->where('system_id', '=', $system_id)->take($request->limit)->get();
        }
        return $versions;
    }
    public function store(Request $request, $system_id) {
        /*
            表单验证
        */
        $system = System::withTrashed()->find($system_id);
        $now = 0;
        foreach($system->version()->get() as $ver) {
            if($ver->build > $now) {
                $now = $ver->build;
            }
        }
        $path = $request->file('file')->store('public/apps');
        $version = new Version;
        $version->system_id = $system_id;
        $version->build = $now + 1;
        $version->file_url = $path;
        $version->version = $request->version;
        $version->save();
        return $version;
    }
    public function delete(Request $request, $system_id) {
        $version = Version::find($request->version_id);
        $version->delete();
        return [];
    }
    public function restore(Request $request, $system_id) {
        $version = Version::onlyTrashed()->find($request->version_id);
        $version->restore();
        return $version;
    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//app

Route::get('applist', 'AppController@show');

Route::post('addapp', 'AppController@create');

Route::delete('{app_id}/deleteapp', 'AppController@delete');

Route::put('{app_id}/readdapp', 'AppController@readd');

//image

Route::get('{system_id}/image', 'ImageController@show');

Route::post('{system_id}/image', 'ImageController@store');

//data

Route::get('{app_id}/data', 'DataController@show');

Route::post('{app_id}/data', 'DataController@store');

Route::put('{app_id}/data', 'DataController@change');

Route::delete('{app_id}/data', 'DataController@delete');

//feedback

Route::get('{app_id}/feedback', 'FeedbackController@showApp');

Route::post('{app_id}/feedback', 'FeedbackController@store');

Route::delete('{app_id}/feedback', 'FeedbackController@delete');

//first_screen

Route::get('{app_id}/first_screen', 'FirstScreenController@show');

Route::post('{app_id}/first_screen', 'FirstScreenController@store');

Route::put('{app_id}/first_screen', 'FirstScreenController@active');

Route::delete('{app_id}/first_screen', 'FirstScreenController@delete');

//system

Route::get('{app_id}/system', 'SystemController@show');

Route::post('{app_id}/system', 'SystemController@store');

Route::delete('{app_id}/system', 'SystemController@delete');

Route::put('{app_id}/system', 'SystemController@restore');

//download

Route::get('{system_id}/download', 'DownloadController@show');

//version

Route::get('{system_id}/version', 'VersionController@show');

Route::post('{system_id}/version', 'VersionController@store');

Route::delete('{system_id}/version', 'VersionController@delete');

Route::put('{system_id}/version', 'VersionController@restore');

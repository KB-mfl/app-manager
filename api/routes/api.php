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

/* 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//user

Route::post('register', 'UserController@register');

Route::post('login', 'UserController@login');

Route::post('logout', 'UserController@logout');

Route::get('check', 'UserController@check');

//app

Route::get('applist', 'AppController@show');

Route::post('addapp', 'AppController@create')->middleware('Check');

Route::delete('{app_id}/deleteapp', 'AppController@delete')->middleware('Check');

Route::put('{app_id}/readapp', 'AppController@read')->middleware('Check');

//image

Route::get('{system_id}/image', 'ImageController@show');

Route::post('{system_id}/image', 'ImageController@store')->middleware('Check');

//data

Route::get('{app_id}/data', 'DataController@show');

Route::post('{app_id}/data', 'DataController@store')->middleware('Check');

Route::put('{app_id}/data', 'DataController@change')->middleware('Check');

Route::delete('{app_id}/data', 'DataController@delete')->middleware('Check');

//feedback

Route::get('{app_id}/feedback', 'FeedbackController@showApp');

Route::post('{app_id}/feedback', 'FeedbackController@store')->middleware('Check');

Route::delete('{app_id}/feedback', 'FeedbackController@delete')->middleware('Check');

//first_screen

Route::get('{app_id}/first_screen', 'FirstScreenController@show');

Route::post('{app_id}/first_screen', 'FirstScreenController@store')->middleware('Check');

Route::put('{app_id}/first_screen', 'FirstScreenController@active')->middleware('Check');

Route::delete('{app_id}/first_screen', 'FirstScreenController@delete')->middleware('Check');

//system

Route::get('{app_id}/system', 'SystemController@show');

Route::post('{app_id}/system', 'SystemController@store')->middleware('Check');

Route::delete('{app_id}/system', 'SystemController@delete')->middleware('Check');

Route::put('{app_id}/system', 'SystemController@restore')->middleware('Check');

//download

Route::get('download', 'DownloadController@show');

//version

Route::get('{system_id}/version', 'VersionController@show');

Route::post('{system_id}/version', 'VersionController@store')->middleware('Check');

Route::delete('{system_id}/version', 'VersionController@delete')->middleware('Check');

Route::put('{system_id}/version', 'VersionController@restore')->middleware('Check');

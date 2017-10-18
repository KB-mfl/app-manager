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

//user

Route::post('register', 'UserController@register');

Route::post('login', 'UserController@login');

//app

Route::get('applist', 'AppController@show')->middleware('AddTime');

Route::post('addapp', 'AppController@create')->middleware('Check');

Route::delete('{app_id}/deleteapp', 'AppController@delete')->middleware('Check');

Route::put('{app_id}/readapp', 'AppController@read')->middleware('Check');

//image

Route::any('image/{img_name}', 'ImageController@show');//->middleware('AddTime');

Route::post('{system_id}/image', 'ImageController@store')->middleware('Check');

//data

Route::get('{app_id}/data', 'DataController@show')->middleware('AddTime');

Route::post('{app_id}/data', 'DataController@store')->middleware('Check');

Route::put('{app_id}/data', 'DataController@change')->middleware('Check');

Route::delete('{app_id}/data', 'DataController@delete')->middleware('Check');

//feedback

Route::get('{app_id}/feedback', 'FeedbackController@showApp')->middleware('AddTime');

Route::get('user/{user_id}/feedback', 'FeedbackController@showUser')->middleware('AddTime');

Route::post('{app_id}/feedback', 'FeedbackController@store')->middleware('AddTime');

Route::delete('{app_id}/feedback', 'FeedbackController@delete')->middleware('CheckFeedback');

//first_screen

Route::get('{app_id}/first_screen', 'FirstScreenController@show')->middleware('AddTime');

Route::post('{app_id}/first_screen', 'FirstScreenController@store')->middleware('Check');

Route::put('{app_id}/first_screen', 'FirstScreenController@active')->middleware('Check');

Route::delete('{app_id}/first_screen', 'FirstScreenController@delete')->middleware('Check');

//system

Route::get('{app_id}/system', 'SystemController@show')->middleware('AddTime');

Route::post('{app_id}/system', 'SystemController@store')->middleware('Check');

Route::delete('{app_id}/system', 'SystemController@delete')->middleware('Check');

Route::put('{app_id}/system', 'SystemController@restore')->middleware('Check');

//download

Route::get('download', 'DownloadController@show')->middleware('AddTime');

//version

Route::get('{system_id}/version', 'VersionController@show')->middleware('AddTime');

Route::post('{system_id}/version', 'VersionController@store')->middleware('Check');

Route::delete('{system_id}/version', 'VersionController@delete')->middleware('Check');

Route::put('{system_id}/version', 'VersionController@restore')->middleware('Check');

Route::get('version', 'VersionController@seleteByName')->middleware('AddTime');
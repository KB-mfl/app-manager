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

Route::get('app', 'AppController@show')->middleware('AddTime');

Route::get('user/{user_id}/app', 'AppController@showadmin')->middleware('Check');

Route::get('app/{app_id}', 'AppController@showdetail')->middleware('AddTime');

Route::post('app/add', 'AppController@store')->middleware('Check');

Route::delete('app/delete', 'AppController@delete')->middleware('Check');

Route::put('app/restore', 'AppController@restore')->middleware('Check');

//image

Route::get('image/{image_name}', 'ImageController@show');//->middleware('AddTime');

Route::post('image', 'ImageController@store')->middleware('Check');

//android

Route::post('app/{app_id}/android', 'AndroidController@store')->middleware('Check');

Route::delete('app/{app_id}/android', 'AndroidController@delete')->middleware('Check');

Route::put('app/{app_id}/android', 'AndroidController@restore')->middleware('Check');

//ios

Route::post('app/{app_id}/ios', 'IosController@store')->middleware('Check');

Route::delete('app/{app_id}/ios', 'IosController@delete')->middleware('Check');

Route::put('app/{app_id}/ios', 'IosController@restore')->middleware('Check');

//data

Route::get('app/{app_id}/data', 'DataController@show')->middleware('AddTime');

Route::post('app/{app_id}/data', 'DataController@store')->middleware('Check');

Route::put('app/{app_id}/data', 'DataController@change')->middleware('Check');

Route::delete('app/{app_id}/data', 'DataController@delete')->middleware('Check');

//feedback

Route::get('app/{app_id}/feedback', 'FeedbackController@showApp')->middleware('AddTime');

Route::post('app/{app_id}/feedback', 'FeedbackController@store')->middleware('AddTime');

Route::delete('app/{app_id}/feedback', 'FeedbackController@delete')->middleware('CheckFeedback');

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

Route::get('app/{app_id}/version', 'VersionController@show')->middleware('AddTime');

Route::post('app/{app_id}/version', 'VersionController@store')->middleware('Check');

Route::delete('app/{app_id}/version', 'VersionController@delete')->middleware('Check');

Route::put('app/{app_id}/version', 'VersionController@restore')->middleware('Check');

Route::get('version', 'VersionController@seleteByName')->middleware('AddTime');
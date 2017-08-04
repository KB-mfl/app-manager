<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/test', function() {
    return view('test');
});


//app

Route::get('/api/appmanager/applist', 'AppController@show');

Route::post('/api/appmanager/addapp', 'AppController@create');

Route::delete('/api/appmanager/{app_id}/deleteapp', 'AppController@delete');

Route::put('/api/appmanager/{app_id}/readdapp', 'AppController@readd');

//history

Route::get('/api/appmanager/{app_id}/history', 'HistoryController@show');

Route::delete('/api/appmanager/{app_id}/history', 'HistoryController@delete');

Route::put('/api/appmanager/{app_id}/history', 'HistoryController@recover');

Route::post('/api/appmanager/{app_id}/history', 'HistoryController@store');

//download

Route::get('/api/appmanager/{app_id}/download', 'DownloadController@show');

//image

Route::post('/api/appmanager/{app_id}/image', 'ImageController@store');

//data

Route::get('/api/appmanager/{app_id}/data', 'DataController@show');

Route::post('/api/appmanager/{app_id}/data', 'DataController@store');

Route::put('/api/appmanager/{app_id}/data', 'DataController@change');

Route::delete('/api/appmanager/{app_id}/data', 'DataController@delete');
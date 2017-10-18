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

Route::any('/apple', function() {
    return view('apple');
});
Route::any('/test', function() {
    return view('test');
})->name('mytest');

Route::any('/test2', function() {
    return view('test2');
})->name('mytest2');



Route::post('register', 'UserController@register');

Route::post('login', 'UserController@login');

Route::post('logout', 'UserController@logout');

Route::get('check', 'UserController@check');

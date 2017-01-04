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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

// Users Route
Route::get('/users/grid', 'UserController@getGrid');
Route::get('/users/export', 'UserController@export');
Route::resource('/users', 'UserController');

Route::get('/tweets/grid', 'TweetController@getGrid');
Route::get('/tweets/export', 'TweetController@export');
Route::resource('/tweets', 'TweetController');

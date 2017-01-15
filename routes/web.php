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

Route::get('/revisions/grid', 'RevisionController@getGrid');

// Users Route
Route::get('/users/grid', 'UserController@getGrid');
Route::get('/users/export', 'UserController@export');
Route::get('/users/{user_id}/roles', 'UserController@roles');
Route::delete('/users/{user_id}/roles', 'UserController@removeUserRole');
Route::post('/users/{user_id}/roles', 'UserController@addUserRole');
Route::resource('/users', 'UserController');

Route::get('/tweets/grid', 'TweetController@getGrid');
Route::get('/tweets/export', 'TweetController@export');
Route::resource('/tweets', 'TweetController');

// Role Route
Route::get('/roles/grid', 'RoleController@getGrid');
Route::get('/roles/export', 'RoleController@export');
Route::get('/roles/{role_id}/permissions', 'RoleController@permissions');
Route::delete('/roles/{role_id}/permissions', 'RoleController@removeRolePermission');
Route::post('/roles/{role_id}/permissions', 'RoleController@addRolePermission');
Route::resource('/roles', 'RoleController');

// Permission Route
Route::get('/permissions/grid', 'PermissionController@getGrid');
Route::get('/permissions/export', 'PermissionController@export');
Route::resource('/permissions', 'PermissionController');
<?php

use illuminate\http\request;

/*
|--------------------------------------------------------------------------
| api routes
|--------------------------------------------------------------------------
|
| here is where you can register api routes for your application. these
| routes are loaded by the routeserviceprovider within a group which
| is assigned the "api" middleware group. enjoy building your api!
|
*/

//route::middleware('auth:api')->get('/user', function (request $request) {
//    return $request->user();
//});

Route::post('/auth/login', [
    'uses' => 'authcontroller@login',
]);

Route::post('/auth/logout', [
    'uses' => 'authcontroller@logout'
]);

Route::get('/auth/user', [
    'uses' => 'authcontroller@getUser'
]);


Route::post('/user/add', [
    'uses' => 'usercontroller@addUser',
    'middleware' => 'auth.jwt'
]);
Route::get('/user/form', [
    'uses' => 'usercontroller@getformdata'
]);

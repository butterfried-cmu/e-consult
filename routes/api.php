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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/auth/login', [
    'uses' => 'AuthController@login'
]);

Route::post('/auth/logout', [
    'uses' => 'AuthController@logout'
]);

Route::get('/auth/user', [
    'uses' => 'AuthController@getUser'
]);


Route::post('/user/add', [
    'uses' => 'UserController@add'
]);

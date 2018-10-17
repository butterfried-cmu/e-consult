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

/*
 * Auth (Account)
 */
Route::post('/auth/login', [
    'uses' => 'authcontroller@login',
]);

Route::any('/auth/logout', [
    'uses' => 'authcontroller@logout'
]);
Route::get('/auth/refresh', [
    'uses' => 'authcontroller@onRefresh',
//    'middleware' => ['auth.jwt']
]);
Route::post('/auth/password/request', [
    'uses' => 'authcontroller@requestForResettingPassword',
//    'middleware' => ['auth.jwt']
]);
Route::post('/auth/password/reset', [
    'uses' => 'authcontroller@resetPassword',
//    'middleware' => ['auth.jwt']
]);

/*
 * User
 */
Route::get('/users', [
    'uses' => 'usercontroller@getUserList',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/users/{user_id}', [
    'uses' => 'usercontroller@getUserById',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/users/add', [
    'uses' => 'usercontroller@addUser',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/users/delete/{user_id}', [
    'uses' => 'usercontroller@deleteUser',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/users/update', [
    'uses' => 'usercontroller@updateUser',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/users/search', [
    'uses' => 'usercontroller@getUsersByKeyword',
//    'middleware' => ['auth.jwt']
]);

/*
 * Consult
 */
Route::post('/consults', [
    'uses' => 'consultcontroller@postCreateConsult',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/consults/draft/{user_id}', [
    'uses' => 'consultcontroller@getDraftConsultList',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/consults/pending', [
    'uses' => 'consultcontroller@getPendingConsultList',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/consults/done', [
    'uses' => 'consultcontroller@getDoneConsultList',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/consults/search', [
    'uses' => 'consultcontroller@postFindConsultByKeyword',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/consults/{consult_id}', [
    'uses' => 'consultcontroller@getConsultById',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/consults/{consult_id}', [
    'uses' => 'consultcontroller@postEditConsult',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/consults/{consult_id}/delete', [
    'uses' => 'consultcontroller@getDeleteDraftConsult',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/consults/{consult_id}/send', [
    'uses' => 'consultcontroller@getSendDraftConsult',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/consults/{consult_id}/reply', [
    'uses' => 'consultcontroller@postReplyConsult',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);

/*
 * Message
 */
Route::get('/messages/{consult_id}', [
    'uses' => 'messagecontroller@getMessageHistory',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/messages/{consult_id}', [
    'uses' => 'messagecontroller@postSendMessage',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/messages/{consult_id}/attachments', [
    'uses' => 'messagecontroller@getAttachmentList',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::post('/messages/{consult_id}/attachments', [
    'uses' => 'messagecontroller@postSendAttachment',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);
Route::get('/messages/download/{attachment_id}', [
    'uses' => 'messagecontroller@getDownloadAttachment',
//    'middleware' => ['auth.jwt', 'role:ADMIN']
]);

Route::get('/consults/{consult_id}/print', [
    'uses' => 'consultcontroller@printConsultForm',
]);
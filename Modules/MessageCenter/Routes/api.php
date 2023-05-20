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

Route::middleware('auth:api')->get('/messagecenter', function (Request $request) {
    return $request->user();
});

Route::post('/client/send/message', 'MessageCenterController@send_message');
Route::post('/client/send/message_client', 'MessageCenterController@send_message_client');

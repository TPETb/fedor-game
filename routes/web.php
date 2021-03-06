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

Route::get('/webhook', 'WebHookController@webhook');
Route::post('/webhook', 'WebHookController@webhook');

Route::get('/message', "MessageController@test");

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

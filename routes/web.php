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

Route::get('/bot/webhook', 'BotController@subscribe');
Route::post('/bot/webhook', 'BotController@receiveMessaging');

Route::get('/bot/menu/add', 'BotController@addMenu');
Route::get('/bot/menu/remove', 'BotController@removeMenu');
Route::get('/bot/getstarted/add', 'BotController@addGetStarted');
Route::get('/bot/getstarted/remove', 'BotController@removeGetStarted');

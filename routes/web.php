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
    return view('tinker');
});

Route::match(['get', 'post'], '/chats', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

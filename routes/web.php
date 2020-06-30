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

Route::get('/service', 'SoapController@index');
Route::post('/index.php/EchoTransaction', 'SoapController@EchoTransaction');
Route::get('/index.php/EchoTransaction', 'SoapController@EchoTransaction');
Route::post('/test', 'SoapController@test');

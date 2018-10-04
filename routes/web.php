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

Route::get('/', 'PinsController@index');

Route::resource('pins', 'PinsController');

Auth::routes();

// Route::get('/home', 'HomeController@index');

Route::post('/pins/save_link_data', 'PinsController@save_link_data');

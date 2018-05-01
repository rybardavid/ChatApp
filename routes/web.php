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

Route::get('/', 'MainController@mainPage');
Route::get('/logout', 'MainController@logout');
Route::get('/getpeople', 'UserController@getUsers');
Route::get('/getrequests', 'UserController@getRequests');

Route::post('/sendrequest', 'UserController@sendRequest');
Route::post('/acceptrequest', 'UserController@acceptRequest');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

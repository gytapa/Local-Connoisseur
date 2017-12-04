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
    return view('home');
});

//serach route
Route::get('search', 'SearchController@displayData');

Auth::routes();

//home routes
Route::get('/home', 'HomeController@index')->name('home');
//registration routes
Route::get('/register', 'UserController@viewForm');
Route::post('/register', 'UserController@create');
//login routes
Route::get('/login', 'UserController@viewLogin');
Route::post('/login', 'UserController@login');

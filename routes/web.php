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
//logout route
Route::get('/logout','UserController@logout');
//userpage route
Route::get('/userpage', 'userDataController@displayUserData');
//confirm users route
Route::get('/confirmusers', 'userDataController@confirmUsers');
Route::get('/confirm/{uid}', 'userDataController@confirmUser');
//places route
Route::get('/places', 'PlacesController@getPlaces');
//places evalution route
Route::get('/places/evaluate/{pid}/{evaluation}', 'PlacesController@Evaluate');
//info of place route
Route::get('/infoOfPlace/{pid}', 'PlacesController@getInfoOfPlace');
//Comment route
Route::post('/infoOfPlace/send', 'CommentsController@send');
//evaluate comment route
Route::get('/infoOfPlace/evaluate/{cid}/{evaluation}/{pid}', 'CommentsController@Evaluate');
//visited place
Route::get('/infoOfPlace/visited/{pid}', 'PlacesController@visited');
//visited submit
Route::post('/infoOfPlace/submitVisited', 'PlacesController@submitVisited');
//List route
Route::get('/lists', 'ListsController@getMyLists');
//info of list
Route::get('/lists/infoOfList/{lid}', 'ListsController@getInfoOfList');
//new list
Route::get('/lists/newList', 'ListsController@newList');
//new list
Route::post('/lists/submitNewList', 'ListsController@submitNewList');

Route::get('/userslist', 'userDataController@getUsersList');

Route::get('/visits', 'PlacesController@getVisits');

Route::get('/deleteComment/{cid}', 'CommentsController@delete');

Route::get('/infoOfPlace/addToList/{pid}', 'ListsController@addToList');

Route::post('/infoOfPlace/addToList/add', 'ListsController@add');

Route::get('/lists/infoOfList/editAddedPlace/{id}', 'ListsController@editAddedPlace');

Route::get('/lists/infoOfList/deleteAddedPlace/{id}', 'ListsController@deleteAddedPlace');

Route::post('/lists/infoOfList/submitNewPlaceDesc', 'ListsController@submitNewPlaceDesc');

Route::get('/lists/deleteList/{id}', 'ListsController@deleteList');

Route::get('/userpage/addDocument' , 'UserDataController@addDocument');

Route::post('/userpage/addDocument/submit', 'UserDataController@addDocumentSubmit');
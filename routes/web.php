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
//about route
Route::get('/about', 'HomeController@about');
//contact route
Route::get('/contacts', 'HomeController@contact');
//login routes
Route::get('/login', 'UserController@viewLogin');
Route::post('/login', 'UserController@login');
//change passworld routes
Route::get('/changepass','UserController@changePasswordView');
Route::post('/changepass','UserController@changePassword');
//logout route
Route::get('/logout','UserController@logout');
//userpage route
Route::get('/userpage', 'UserDataController@displayUserData');
//confirm users route
Route::get('/confirmusers', 'UserDataController@confirmUsers');
Route::get('/confirm/{uid}', 'UserDataController@confirmUser');
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
//userlist route
Route::get('/userslist', 'userDataController@getUsersList');
//visits history route
Route::get('/visits', 'PlacesController@getVisits');
//comment delete route
Route::get('/deleteComment/{cid}', 'CommentsController@delete');
//comment edit route
Route::get('/editComment/{cid}', 'CommentsController@edit');
//comment edit route
Route::post('/editComment/submit', 'CommentsController@editSubmit');
//add to list route
Route::get('/infoOfPlace/addToList/{pid}', 'ListsController@addToList');
//add to lsit submit route
Route::post('/infoOfPlace/addToList/add', 'ListsController@add');
//edit added place route
Route::get('/lists/infoOfList/editAddedPlace/{id}', 'ListsController@editAddedPlace');
//delete added palce route
Route::get('/lists/infoOfList/deleteAddedPlace/{id}', 'ListsController@deleteAddedPlace');
//edit added place submit
Route::post('/lists/infoOfList/submitNewPlaceDesc', 'ListsController@submitNewPlaceDesc');
//delete list route
Route::get('/lists/deleteList/{id}', 'ListsController@deleteList');
//add document route
Route::get('/userpage/addDocument' , 'UserDataController@addDocument');
//submit document route
Route::post('/userpage/addDocument/submit', 'UserDataController@addDocumentSubmit');
//downlaod docuemtn route
Route::get('/userpage/download/{name}', 'UserDataController@downloadDocument');
//block user route
Route::get('/userlist/block/{id}', 'UserDataController@blockUser');
//submit block route
Route::post('/userlist/block/submitBlock', 'UserDataController@submitBlock');
//unblock user route
Route::get('/userlist/unblock/{id}' , 'UserDataController@unblock');
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

Route::domain('admin.lighthouse.test')->group(function(){
	Route::get('/', 'DashController@getStats')->middleware('auth');

	Route::get('/events', 'EventController@adminEventView')->middleware('auth');

	Route::post('/addevent', 'EventController@handleForm')->middleware('auth');

	Route::get('/getevent/{id}', 'EventController@getEventJSON');

	Route::post('/updateevent', 'EventController@updateEevent')->middleware('auth');
});

Route::domain('lighthouse.test')->group(function(){
	Route::get('/', 'HomeController@index');
	Route::get('/event/{id}', 'EventController@paginateEvent');
	Route::get('/events/{pagenum?}', 'EventController@eventListView');
	Route::get('/getEventRange', 'EventController@getEventsByDate');
});


Auth::routes();

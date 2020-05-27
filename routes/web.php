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

Route::domain('admin.lighthouse.test')->middleware(['AuthCheck'])->group(function(){
	Route::get('/', 'DashController@getStats')->middleware('auth')->name('admin_dashboard');

	Route::get('/events', 'EventController@adminEventView')->middleware('auth')->name('admin_events');
	Route::post('/addevent', 'EventController@handleForm')->middleware('auth');
	Route::get('/getevent/{id}', 'EventController@getEventJSON');
	Route::post('/updateevent', 'EventController@updateEevent')->middleware('auth');
	
	Route::get('/announcements', 'AnnouncementController@adminAnnouncementsView')->middleware('auth');
	Route::post('/announcementsAction', 'AnnouncementController@announcementsFormAction');
	Route::get('/getAnnouncement/{id}', 'AnnouncementController@getAnnouncementJSON');

	Route::get('/forms', 'FormsController@formView');	
	Route::post('/formsAction', 'FormsController@formAction');
	Route::get('/getform/{id}','FormsController@getForm');

	Route::get('/users', 'UsersController@returnView');
	Route::get('/getUser/{id}', 'UsersController@getUser');
	Route::post('/userFormAction', 'UsersController@formHandler');

});

Route::domain('lighthouse.test')->group(function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/event/{id}', 'EventController@paginateEvent')->name('event');
	Route::get('/events/{pagenum?}', 'EventController@eventListView')->name('events');
	Route::get('/getEventRange', 'EventController@getEventsByDate');
	Route::get('/forms/{pagenum?}', 'FormsController@formsList');
});


Auth::routes();

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
	Route::get('/home', 'DashController@getStats')->middleware('auth');

	Route::get('/events', 'EventController@adminEventView')->middleware('auth')->name('events');
	Route::post('/addevent', 'EventController@handleForm')->middleware('auth');
	Route::get('/getevent/{id}', 'EventController@getEventJSON');
	Route::post('/updateevent', 'EventController@updateEevent')->middleware('auth');
	
	Route::get('/announcements', 'AnnouncementController@adminAnnouncementsView')->middleware('auth')->name('announcements');
	Route::post('/announcementsAction', 'AnnouncementController@announcementsFormAction');
	Route::get('/getAnnouncement/{id}', 'AnnouncementController@getAnnouncementJSON');

	Route::get('/forms', 'FormsController@formView')->middleware('auth')->name('forms');	
	Route::post('/formsAction', 'FormsController@formAction');
	Route::get('/getform/{id}','FormsController@getForm');

	Route::get('/users', 'UsersController@returnView')->middleware('auth')->name('users');
	Route::get('/getUser/{id}', 'UsersController@getUser');
	Route::post('/userFormAction', 'UsersController@formHandler');

	Route::get('/videos', 'VideoController@videoView')->middleware('auth')->name('videos');
	Route::post('/videoformaction', 'VideoController@videoAction');
	Route::get('/getVideo/{id}', 'VideoController@getVideo');
});

Route::domain('admin.lighthouse.test')->group(function(){
	Auth::routes();
});

Route::domain('lighthouse.test')->group(function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/event/{id}', 'EventController@paginateEvent')->name('events');
	Route::get('/events/{pagenum?}', 'EventController@eventListView')->name('events');
	Route::get('/getEventRange', 'EventController@getEventsByDate');
	Route::get('/forms/{pagenum?}', 'FormsController@formsList')->name('forms');
	Route::get('/announcement/{pagenum?}', 'AnnouncementController@announcementView');
	Route::get('/announcements/{pagenum?}', 'AnnouncementController@announcementListView')->name('announcements');
	Route::get('/videos/{pagenum?}', 'VideoController@videoPageView')->name('videos');
	Route::get('/getVideo/{id}', 'VideoController@getVideo');
});

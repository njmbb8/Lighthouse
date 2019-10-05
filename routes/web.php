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
	Route::get('/', function(){
		return view('admin.dashboard');
	});
});

Route::get('/', function () {
    return view('home');
});

//user registration and login routes
Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');
 
Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

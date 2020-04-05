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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/lead', 'LeadController@index')->name('lead')->middleware('can:edit_lead');

Route::view('/demo', 'demo');



Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('darko.vasic@gmail.com');
	});
});

Route::get('/clear-cache', 'ClearCacheController@index')->middleware('can:register_user');

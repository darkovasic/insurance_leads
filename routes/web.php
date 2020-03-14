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

Route::group(['middleware' => 'web'], function () {
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
    ]);
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');
});

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
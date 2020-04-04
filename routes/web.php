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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');

    $return =
        "url: '" . env('DATABASE_URL') . "'<br>" .
        "host: '" . env('DB_HOST') . "'<br>" .
        "port: '" . env('DB_PORT') . "'<br>" .
        "database: '" . env('DB_DATABASE') . "'<br>" .
        "username: '" . env('DB_USERNAME') . "'<br>" .
        "password: '" . env('DB_PASSWORD') . "'<br>" .
        "<br>DONE<br>";

    return 'DONE'; //Return anything
});
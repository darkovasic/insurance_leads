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
    if (Auth::check()) {
        return view('/lead');
    } else {
        return view('auth.login');
    }
});


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/lead', 'LeadController@index')->name('lead')->middleware('can:edit_lead');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });
    Route::view('/dashboard', 'admin.dashboard');
    Route::resource('/users','Admin\UserController');
    Route::get('/recent-activities', 'Admin\ApiRequestLogController@index');
    Route::get('/email-log', 'Admin\SentEmailsLogController@index');

    Route::view('/ui', 'admin.ui');
});

Route::get('/clear-cache', 'ClearCacheController@index');

Route::get('/db-migrate', 'DbMigrateController@index')->middleware('can:register_user');

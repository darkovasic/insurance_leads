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

Route::get('/lead', 'LeadController@index')->name('lead')->middleware('can:edit_lead');

Route::view('/admin/dashboard', 'admin.dashboard');
Route::resource('/admin/users','Admin\UserController')->middleware('can:register_user');
Route::view('/admin/ui', 'admin.ui');

Route::get('/clear-cache', 'ClearCacheController@index');

Route::get('/db-migrate', 'DbMigrateController@index')->middleware('can:register_user');

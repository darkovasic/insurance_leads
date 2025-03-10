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
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('/users','Admin\UserController');
    Route::get('/leads/import', 'Admin\ImportLeadsController@index')->name('leads.import');
    Route::post('/import-leads', 'Admin\ImportLeadsController@import')->name('import-leads');
    Route::resource('/leads','Admin\LeadController');
    Route::resource('/brokers','Admin\BrokerController');
    Route::get('/recent-activities', 'Admin\ApiRequestLogController@index');
    Route::get('/email-log', 'Admin\SentEmailsLogController@index');
    Route::get('/import-error-log', 'Admin\ImportErrorLogController@index')->name('import-log');
    // Route::view('/ui', 'admin.ui');
});

Route::get('/clear-cache', 'ClearCacheController@index');

Route::get('/db-migrate', 'DbMigrateController@index')->middleware('can:register_user');

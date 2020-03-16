<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth'], function() {
    
    Route::post('lead/{id}', 'LeadController@store');
    Route::get('lead/{id}', 'LeadController@get');
    Route::delete('lead/{id}', 'LeadController@delete');

    Route::get('bp-auth', 'ApiAuthController@boldPenguinAuth');

});



<?php

use Illuminate\Http\Request;
use App\Mail\SendErEmail;

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
    
    Route::put('lead/{id}', 'LeadController@store');
    Route::post('lead', 'LeadController@get');
    Route::delete('lead/{id}', 'LeadController@delete');

    Route::post('send-lead', 'ApiController@boldPenguinAuth');

    Route::post('send-er-email', function(Request $request) {
        $id = $request->input('id');
        $email = new SendErEmail($id);
        Mail::send($email);
    });

});



<?php

use Illuminate\Http\Request;
// use GuzzleHttp\Client;

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

    Route::get('json-api', 'ApiController@index');
    // Route::get('/json-api', function() {
    //     $client = new Client();
    
    //     $response = $client->request('GET', 'https://desertebs.com/api/dummy/posts');
    //     $statusCode = $response->getStatusCode();
    //     $body = $response->getBody()->getContents();
    
    //     return $body;
    // });
});



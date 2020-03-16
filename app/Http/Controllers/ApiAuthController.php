<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class ApiAuthController extends Controller
{
    public function boldPenguinAuth() {

        $endpoint = env('BOLD_PENGUIN_STAGING_URL_AUTH');
        $username = env('BOLD_PENGUIN_STAGING_CLIENT_ID');
        $password = env('BOLD_PENGUIN_STAGING_CLIENT_SECRET');
        
        try {
            $client = new Client();
            $request = $client->request('POST', $endpoint, [
                'auth' => [
                    $username, 
                    $password
                ]
            ]);

            $response = json_decode($request->getBody());
            $access_token = $response->access_token;

            $minutes = $response->expires_in / 60;
            Cookie::queue(Cookie::make('bp_token', $access_token, $minutes));


        } catch (GuzzleException $error) {
            dd($error);
        }


        // $request = new \GuzzleHttp\Psr7\Request('POST', $endpoint, [
        //     'auth' => [
        //         $username, 
        //         $password
        //     ]            
        // ]);

        // $promise = $client->sendAsync($request)->then(function ($response) {
        //     echo 'I completed! ' . $response->getBody();
        // });
        
        // $promise->wait();      
        
        
        // $credentials = base64_encode("$username:$password");
        // $response = $client->post($endpoint,
        //         [
        //             'headers' => [
        //                 'Authorization' => 'Basic ' . $credentials,
        //             ],
        //         ]);

    }
}

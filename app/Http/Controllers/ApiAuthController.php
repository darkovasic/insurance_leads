<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cookie;

class ApiAuthController extends Controller
{
    public function boldPenguinAuth(Request $lead) {

        $username   = env('BOLD_PENGUIN_STAGING_CLIENT_ID');
        $password   = env('BOLD_PENGUIN_STAGING_CLIENT_SECRET');
        $urlAuth    = env('BOLD_PENGUIN_STAGING_URL_AUTH');
        $urlCreate  = env('BOLD_PENGUIN_STAGING_URL_CREATE_FORM');
// dd($lead->telephone);
        if (!Cookie::has('bp_token')) {
            try {
                $client = new Client();
                $request = $client->request('POST', $urlAuth, [
                    'auth' => [
                        $username, 
                        $password
                    ]
                ]);

                $response = json_decode($request->getBody());
                $access_token = $response->access_token;
                $minutes = $response->expires_in / 60;

                Cookie::queue(Cookie::make('bp_token', $access_token, $minutes));

                return $access_token;

            } catch (GuzzleException $error) {
                dd($error);
            }

        } else {
            try {
                $access_token = Cookie::get('bp_token');

                $curl = curl_init();
                $headers = [
                    'Authorization: Bearer ' . $access_token,
                    'Content-Type: application/json'
                ];
                $data = [
                    'application_form' => [
                        'answer_values' => [
                            (object) ['code' => 'mqs_business_name', 'answer' => $lead->dba_name],
                            (object) ['code' => 'mqs_phone', 'answer' => $lead->telephone],
                            (object) ['code' => 'mqs_first_name', 'answer' => $lead->legal_name],
                            (object) ['code' => 'mqs_email', 'answer' => $lead->email_address],
                            (object) ['code' => 'mqs_street_1', 'answer' => $lead->phy_street],
                            (object) ['code' => 'mqs_city', 'answer' => $lead->phy_city],
                            (object) ['code' => 'mqs_state', 'answer' => $lead->phy_state],
                            // (object) ['code' => 'mqs_zipcode', 'answer' => $lead->phy_zip],
                            (object) ['code' => 'mqs_full_time_employees', 'answer' => $lead->driver_total],
                        ]
                    ]
                ];
            
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_URL, $urlCreate);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($curl);
                curl_close($curl);

                // $headers = [
                //     'Content-Type' => 'application/json',
                //     'Authorization' => 'Bearer ' . $access_token,
                // ];

                // $client = new Client([
                //     'headers' => $headers
                // ]);

                // $request = $client->request('POST', $urlCreate, [
                //     'data' => [
                //         "application_form" => [
                //             "answer_values" => [
                //                 // (object) [
                //                 // "code" => "mqs_first_name",
                //                 // "answer" => $lead->legal_name
                //                 // ],
                //                 // (object) [
                //                 // "code" => "mqs_email",
                //                 // "answer" => $lead->email_address
                //                 // ],
                //                 // (object) [
                //                 // "code" => "mqs_business_name",
                //                 // "answer" => $lead->dba_name
                //                 // ],
                //                 (object) [
                //                 "code" => "mqs_phone",
                //                 "answer" => $lead->telephone
                //                 ]
                //             ]
                //         ]                   
                //     ]
                // ]);
dd($result);

            } catch (GuzzleException $error) {
                dd($error);
            }
        }
    }
}

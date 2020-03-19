<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\ApiRequestLog;

class ApiController extends Controller
{
    protected $username;
    protected $password;
    protected $urlAuth;
    protected $urlCreate;
    protected $time;

    public function __construct(){
        $this->username   = env('BOLD_PENGUIN_STAGING_CLIENT_ID');
        $this->password   = env('BOLD_PENGUIN_STAGING_CLIENT_SECRET');
        $this->urlAuth    = env('BOLD_PENGUIN_STAGING_URL_AUTH');
        $this->urlCreate  = env('BOLD_PENGUIN_STAGING_URL_CREATE_FORM');
    }

    public function boldPenguinAuth(Request $lead) {

        if (!Cookie::has('bp_token')) {
            try {
                $client = new Client();
                $request = $client->request('POST', $this->urlAuth, [
                    'auth' => [
                        $this->username, 
                        $this->password
                    ]
                ]);
                
                $authResponse = json_decode($request->getBody());
                $access_token = $authResponse->access_token;
                $minutes = $authResponse->expires_in / 60;

                Cookie::queue(Cookie::make('bp_token', $access_token, $minutes));

                $sendResponse = $this->sendLead($access_token, $lead);
                $this->saveResponse($lead->id, $sendResponse);
                return $sendResponse;

            } catch (\Exception $error) {
                dd($error);
            }

        } else {
            $access_token = Cookie::get('bp_token');

            $sendResponse = $this->sendLead($access_token, $lead);
            $this->saveResponse($lead->id, $sendResponse);
            return $sendResponse;
        }
    }

    public function saveResponse($id, $response) {

        $log = new ApiRequestLog;
        $log->user_id = Auth::id();
        $log->lead_id = $id;
        $log->response = $response;
        $log->response_time = $this->time / 1000 . "ms";
        $log->save();

        dd($response);
    }

    public function sendLead($access_token, $lead) {
        
        try {
            $curl = curl_init();

            if ($curl === false) {
                throw new \Exception('failed to initialize');
            }

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
                        (object) ['code' => 'mqs_zipcode', 'answer' => $lead->phy_zip],
                        (object) ['code' => 'mqs_full_time_employees', 'answer' => $lead->driver_total],
                    ]
                ]
            ];

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_URL, $this->urlCreate);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $current_timestamp = Carbon::now()->micro;
            $result = curl_exec($curl);
            $this->time = Carbon::now()->micro - $current_timestamp;

            if ($result === false) {
                throw new \Exception(curl_error($curl), curl_errno($curl));
            }
            
            curl_close($curl);

            return $result;

        } catch (\Exception $error) {
            dd($error);
        }

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
    }
}

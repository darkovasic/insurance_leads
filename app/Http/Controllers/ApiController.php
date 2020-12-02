<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\ApiRequestLog;
use Log;

class ApiController extends Controller
{
    protected $username;
    protected $password;
    protected $urlAuth;
    protected $urlCreate;

    /**
     * Map of request -> BP API codes
     *
     * @var array
     */
    protected $bp_api_codes_map = [
        'phone' => 'mqs_phone',
        'legal_name' => 'mqs_business_name',
        'first_name' => 'mqs_first_name',
        'last_name' => 'mqs_last_name',
        'email_address' => 'mqs_email',
        'phy_street' => 'mqs_street_1',
        'phy_city' => 'mqs_city',
        'phy_state' => 'mqs_state',
        'phy_zip' => 'mqs_zipcode',
        'full_time_employees' => 'mqs_full_time_employees',
        'part_time_employees' => 'mqs_part_time_employees',
        'currently_insured' => 'mqs_currently_insured',
        'years_of_experience' => 'mqs_years_of_experience',
        'legal_entity' => 'mqs_legal_entity',
        'coverage_type' => 'CoverageTypes',
        'actual_years_in_business' => 'mqs_actual_years_in_business'
    ];

    public function __construct() {
        $this->username   = env('BOLD_PENGUIN_CLIENT_ID');
        $this->password   = env('BOLD_PENGUIN_CLIENT_SECRET');
        $this->urlAuth    = env('BOLD_PENGUIN_URL_AUTH');
        $this->urlCreate  = env('BOLD_PENGUIN_URL_CREATE_FORM');
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

                $sendResponse = $this->sendLead($access_token, $lead);

                Cookie::queue(Cookie::make('bp_token', $access_token, $minutes));
                return $sendResponse;

            } catch (\Exception $error) {
                dd($error);
            }

        } else {
            $access_token = Cookie::get('bp_token');

            $sendResponse = $this->sendLead($access_token, $lead);

            return $sendResponse;
        }
    }

    public function sendLead($access_token, $lead) {

        try {
            $data = $this->compileApplicationForm($lead);

            $curl = curl_init();

            if ($curl === false) {
                throw new \Exception('failed to initialize');
            }

            $headers = [
                'Authorization: Bearer ' . $access_token,
                'Content-Type: application/json'
            ];

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_URL, $this->urlCreate);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($curl);

            if ($result === false) {
                throw new \Exception(curl_error($curl), curl_errno($curl));
            }

            $result = json_decode($result);
            isset($result->error) ? $result_id = $result->error : $result_id = $result->id;

            $info = curl_getinfo($curl);
            $total_time = $info['total_time'];

            curl_close($curl);

            $this->saveResponse($lead->id, $data, $result_id, $total_time);

            return json_encode($result);

        } catch (\Exception $error) {
            dd($error);
        }
    }

    public function saveResponse($id, $request, $response, $total_time) {

        try {
            $log = new ApiRequestLog;
            $log->user_id = Auth::id();
            $log->lead_id = $id;
            $log->request = json_encode($request);
            $log->response = $response;
            $log->response_time = $total_time;
            $log->save();
        } catch (\Illuminate\Database\QueryException $error) {
            return $error->getMessage();
        }
    }

    public function getYearsInBusiness($id) {

        $response = DB::select('SELECT TIMESTAMPDIFF(YEAR, add_date_date, CURDATE()) + 1 AS years_in_business FROM leads WHERE id = ' . $id);
        $years = $response[0]->years_in_business;

        return $years;
    }

    /**
     * Compiles application form data
     *
     * @param  string[2]  $lead  Lead request object
     * @return array Compiled application form
     */
    protected function compileApplicationForm($lead) {

        // Init empty application form
        $data = [
            'application_form' => [
                'answer_values' => []
            ]
        ];

        // Update/add missing fields first
        $lead->merge(['phy_state' => \StateHelper::instance()->getStateNameFromAbbreviation($lead->phy_state, 'US')]);
        $lead->merge(['actual_years_in_business' => $this->getYearsInBusiness($lead->id)]);

        // Add items to application form
        foreach ($this->bp_api_codes_map as $property => $code)
        {
            if (!empty($lead->$property))
            {
                $data['application_form']['answer_values'][] = (object) ['code' => $code, 'answer' => $lead->$property];
            }
        }

        return $data;
    }
}
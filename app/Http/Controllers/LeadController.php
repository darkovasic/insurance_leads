<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Carbon\Carbon;

class LeadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('lead');
    }

    public function get(Request $id)
    {

        $term = $id->json()->all();
        $key = array_key_first($term);
        $value = reset($term);

        $lead = Lead::where($key, $value)->first();
        return response()->json($lead);
    }

    public function store($id, Request $request)
    {
        $request->validate([
            'legal_name'                  => 'required',
            'phone'                       => 'required|digits:10',
            'email_address'               => 'required|email',
            // 'dba_name'                    => 'required',
            // 'phy_street'                  => 'required',
            'phy_city'                    => 'required',
            'phy_zip'                     => 'required|digits:5',
            'phy_state'                   => 'required|max:2',
            // 'nbr_power_unit'              => 'required|integer',
            // 'driver_total'                => 'required|integer',
            // 'last_insurance_carrier'      => 'required',
            'last_insurance_date'         => 'required|date',
            // 'insurance_cancellation_date' => 'date',
            // 'comment'                     => '',
            'dot_number'                  => 'required',
            // 'description'                 => 'required',
            'first_name'                  => 'required',
            'last_name'                   => 'required',
            'full_time_employees'         => 'nullable|integer',
            'part_time_employees'         => 'nullable|integer',
            'currently_insured'           => 'nullable|string',
            'years_of_experience'         => 'nullable|integer',
            'legal_entity'                => 'nullable|string',
            'coverage_type'               => 'nullable|string',
        ]);

        $lead = Lead::where('id', $id)->update([
            'legal_name'                  => $request->legal_name,
            'phone'                       => $request->phone,
            'email_address'               => $request->email_address,
            'dba_name'                    => $request->dba_name,
            'phy_street'                  => $request->phy_street,
            'phy_city'                    => $request->phy_city,
            'phy_zip'                     => $request->phy_zip,
            'phy_state'                   => $request->phy_state,
            'nbr_power_unit'              => $request->nbr_power_unit,
            'driver_total'                => $request->driver_total,
            'last_insurance_carrier'      => $request->last_insurance_carrier,
            'last_insurance_date'         => Carbon::parse($request->last_insurance_date)->toDateTimeString(),
            'insurance_cancellation_date' => Carbon::parse($request->insurance_cancellation_date)->toDateTimeString(),
            'comment'                     => $request->comment,
            'dot_number'                  => $request->dot_number,
            'description'                 => $request->description,
            'first_name'                  => $request->first_name,
            'last_name'                   => $request->last_name,
            'full_time_employees'         => $request->full_time_employees,
            'part_time_employees'         => $request->part_time_employees,
            'currently_insured'           => $request->currently_insured,
            'years_of_experience'         => $request->years_of_experience,
            'legal_entity'                => $request->legal_entity,
            'coverage_type'               => $request->coverage_type,
        ]);

        return response()->json($lead);
    }

    public function delete($id)
    {
        Lead::destroy($id);

        return response()->json("ok");
    }
}


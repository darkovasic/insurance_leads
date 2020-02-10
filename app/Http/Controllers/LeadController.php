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

    public function get($id)
    {
        $lead = Lead::where('dot_number', $id)->first();
        return response()->json($lead);
    }

    public function store($id, Request $request)
    {
        $this->validate($request, [
            'legal_name' => 'required',
            'telephone' => 'required',
            'email_address' => 'required|email',
            'dba_name' => 'required',
            'phy_street' => 'required',
            'phy_city' => 'required',
            'phy_zip' => 'required',
            'phy_state' => 'required|max:2',
            'nbr_power_unit' => 'required|integer',
            'driver_total' => 'required|integer',
            'last_insurance_carrier' => 'required',
            'last_insurance_date' => 'required|date',
            'comment' => '',
            'dot_number' => 'required',
            'description' => 'required',          
        ]);

        $lead = Lead::where('dot_number', $id)->update([
            'legal_name' => $request->legal_name,
            'telephone' => $request->telephone,
            'email_address' => $request->email_address,
            'dba_name' => $request->dba_name,
            'phy_street' => $request->phy_street,
            'phy_city' => $request->phy_city,
            'phy_zip' => $request->phy_zip,
            'phy_state' => $request->phy_state,
            'nbr_power_unit' => $request->nbr_power_unit,
            'driver_total' => $request->driver_total,
            'last_insurance_carrier' => $request->last_insurance_carrier,
            'last_insurance_date' => Carbon::parse($request->last_insurance_date)->toDateTimeString(),
            'comment' => $request->comment,
            'dot_number' => $request->dot_number,
            'description' => $request->description,            
        ]);        

        return response()->json($lead);
    }

    public function delete($id)
    {
        Lead::destroy($id);

        return response()->json("ok");
    }
}


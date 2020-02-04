<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

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
        return view('leads');
    }

    public function get($id)
    {
        $lead = Lead::where('dot_number', $id)->first();
        return response()->json($lead);
    }

    public function store($id, Request $request)
    {
// dd($request);        
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
            'last_insururance_date' => $request->last_insururance_date,
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


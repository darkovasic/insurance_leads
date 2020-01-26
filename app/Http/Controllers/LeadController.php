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
        return view('home');
    }

    public function get(Request $request)
    {
        $lead = Lead::where('dot_number', '1000061')->first();
        return response()->json($lead);
    }

    public function store(Request $request)
    {
        $lead = Lead::create($request->all());

        return response()->json($lead);
    }

    public function delete($id)
    {
        Lead::destroy($id);

        return response()->json("ok");
    }
}


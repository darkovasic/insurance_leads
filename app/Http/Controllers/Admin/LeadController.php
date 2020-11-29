<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Lead;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leads = Lead::sortable()
            ->filter($request->all())
            ->paginate(15);

        return view('admin.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = config('constants.states');
        $legal_entities = config('constants.legal_entities');
        $coverage_types = config('constants.coverage_types');

        return view('admin.leads.create', compact('states', 'legal_entities', 'coverage_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'legal_name' => ['required', 'string', 'max:255'],
            'email_address' => ['nullable', 'string', 'email', 'max:255'],
            'phy_city' => ['required', 'string', 'max:255'],
            'phy_zip' => ['required', 'numeric', 'digits:5'],
            'phy_state' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:10'],
        ]);

        $lead = Lead::create($request->all());

        notify()->success('Lead created!');

        return redirect()->route('leads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = config('constants.states');
        $legal_entities = config('constants.legal_entities');
        $coverage_types = config('constants.coverage_types');

        $data = Lead::where('id', $id)->first();
        $lead = json_decode($data);

        return view('admin.leads.edit', compact('lead', 'states', 'legal_entities', 'coverage_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'legal_name' => ['required', 'string', 'max:255'],
            'email_address' => ['nullable', 'string', 'email', 'max:255'],
            'phy_city' => ['required', 'string', 'max:255'],
            'phy_zip' => ['required', 'numeric', 'digits:5'],
            'phy_state' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:10'],
        ]);

        try {
            $lead->update($request->all());
            // $lead->update([
            //     'legal_name' => $request['legal_name'],
            //     'email_address' => $request['email_address'],
            //     'phy_city' => $request['phy_city'],
            //     'phy_zip' => $request['phy_zip'],
            //     'phy_state' => $request['phy_state'],
            //     'first_name' => $request['first_name'],
            //     'phone' => $request['phone'],           
            // ]);
            notify()->success('Lead updated!');
        } catch (\Exception $error) {
            dd($error);
        }

        return redirect()->route('leads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        notify()->success('Lead deleted!');

        return redirect()->route('leads.index');
    }
}

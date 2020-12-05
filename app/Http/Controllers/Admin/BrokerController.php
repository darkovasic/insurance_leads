<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Http\Controllers\Controller;
use App\Broker;

class BrokerController extends Controller
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
        $brokers = Broker::sortable()
            ->filter($request->all())
            ->paginate(15);

        return view('admin.brokers.index', compact('brokers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = config('constants.states');

        return view('admin.brokers.create', compact('states'));
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
            'broker_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'speed_dial' => ['required', 'string', 'max:255'],
            'preferred_comm_service' => ['required', 'string', 'max:255'],
            'contact_first_name' => ['required', 'string', 'max:255'],
            'contact_last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);
// dd($request);
        $broker = Broker::create($request->all());

        // $email = $request->get('email');
        // $data = ([
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     'role' => $request->get('role'),
        // ]);
        // Mail::to($email)->send(new WelcomeMail($data));      

        notify()->success('Broker created!');

        return redirect()->route('brokers.index');
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
        $data = Broker::where('id', $id)->first();
        $broker = json_decode($data);

        return view('admin.brokers.edit', compact('broker', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Broker $broker)
    {
        $request->validate([
            'broker_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'speed_dial' => ['required', 'string', 'max:255'],
            'preferred_comm_service' => ['required', 'string', 'max:255'],
            'contact_first_name' => ['required', 'string', 'max:255'],
            'contact_last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        try {
            $broker->update($request->all());
            notify()->success('Broker updated!');
        } catch (\Exception $error) {
            dd($error);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Broker $broker)
    {
        $broker->delete();
        notify()->success('Broker deleted!');

        return redirect()->route('brokers.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Imports\LeadsImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lead;

class ImportLeadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    public function index()
    {
        return view('admin.leads.import');
    }

    public function import(Request $request) 
    {
        $file = $request->file('file')->store('import');

        $user = auth()->user();
        $import = new LeadsImport($user);
        $import->queue($file);
           
        return back()->withStatus('Import in queue, email will be sent to ' . $user->email . ' when import is finished.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Imports\LeadsImport;
// use Maatwebsite\Excel\Facades\Excel;
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
        $import = new LeadsImport;
        $import->import($file);

if(!empty($import->failures()->items)) dd($import->failures());
// dd($import->failures());
           
        return back()->withStatus('Leads imported successfully');
    }
}

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

        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        // if(!empty($import->failures()->items)) dd($import->failures());
           
        return back()->withStatus('Import in queue, you will receive notification when import is finished.');
    }
}

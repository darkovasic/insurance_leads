<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lead;

class ImportLeadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    public function index(Request $request)
    {

        return view('admin.leads.import');
    }
}

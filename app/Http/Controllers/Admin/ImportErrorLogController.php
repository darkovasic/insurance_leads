<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ImportErrorLog;

class ImportErrorLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    public function index(Request $request)
    {
        $errorLog = ImportErrorLog::sortable()
            // ->filter($request->all())
            ->paginate(15);

        return view('admin.import-error-log', compact('errorLog'));
    }
}

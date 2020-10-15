<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ApiRequestLog;

class ApiRequestLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    public function index()
    {
        $apiLog = ApiRequestLog::sortable()->paginate(15);

        return view('admin.recent-activities', compact('apiLog'));
    }
}

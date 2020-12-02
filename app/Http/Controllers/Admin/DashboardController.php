<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\ApiRequestLog;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    public function index(Request $request)
    {
        $leadsSentCount = ApiRequestLog::whereDate('created_at', Carbon::yesterday())->count();

        return view('admin.dashboard', compact('leadsSentCount'));
    }
}

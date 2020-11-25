<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SentEmailsLog;

class SentEmailsLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:register_user');
    }

    public function index(Request $request)
    {
        $emailLog = SentEmailsLog::sortable()
            ->filter($request->all())
            ->paginate(15);

        return view('admin.email-log', compact('emailLog'));
    }
}

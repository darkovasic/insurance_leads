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

    public function index()
    {
        $data = SentEmailsLog::all();
        $emailLog = json_decode($data);

        return view('admin.email-log', compact('emailLog'));
    }
}

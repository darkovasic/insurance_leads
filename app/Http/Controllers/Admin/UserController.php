<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the registered users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = $this->getUsers();
        // dd($users);
        return view('admin.users', compact('users'));
    }

    public function getUsers()
    {
        $data = User::all();
        $users = json_decode($data);
        return $users;
    }
}

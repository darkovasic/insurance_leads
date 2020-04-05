<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class DbMigrateController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $command = 'migrate';
        $params = [];

        if (getenv('APP_ENV') == 'production')
        {
            $params = ["--force" => true ];
        }

        $stream = fopen("php://output", "w");
        Artisan::call($command, $params, new StreamOutput($stream));

        file_put_contents('php://output', '<br><br>');
        return 'DONE!';
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class ClearCacheController extends Controller
{
    /**
     * Artisan commands to be run
     *
     * @var array
     */
    protected $commands = [
        // 'optimize:clear', // One command to clear them all?
        'cache:clear',
        'config:cache',
        'view:cache',
        'route:clear'
        // 'route:cache', // Ne funkcionise zbog 'closure' u rutama
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $command_output = '';
        foreach ($this->commands as $command)
        {
            $stream = fopen("php://output", "w");
            Artisan::call($command, [], new StreamOutput($stream));
            file_put_contents('php://output', '<br>');
        }

        file_put_contents('php://output', '<br>');
        return 'DONE!';
    }
}


<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class expire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire user every sepisfic time automatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $users = User::where('expire_state',0) -> get();  // get to get all other users whom is not 0
        foreach ($users as $user){
            $user -> update(['expire_state' => 1]);
        }
    }
}

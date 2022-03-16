<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notify email for each user';

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
        //$user = User::select('email')->get(); way 1
        $emails = User::pluck('email')->toArray();
        $data =['title'=> 'programming' , 'body' => 'php'];
        foreach ($emails as $email){
           //how to send email in laravel
            Mail::To($email) ->send(new NotifyEmail($data));
    }
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\MailOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:send-mail {userId?}';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find($this->argument('userId'));
        $order = Order::latest('id')->where('user_id', $user->id)->first();
        $user['order'] = $order; //tim user co id la tham so truyen vao
        Mail::to($user)->send(new MailOrder($user)); //gui mail cho user do bang class Email
    }
}

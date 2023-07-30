<?php

namespace App\Console\Commands;

use App\Mail\MailOrder;
use App\Models\Bill;
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
    protected $signature = 'test:send-mail-order {userId?}';
    protected $bill;
    public function __construct(Bill $bill)
    {
        parent::__construct();
        $this->bill = $bill;
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
        $user['order'] = $order;
        $bills = $this->bill->with(['order', 'product'])->where('order_id', $user->order->id)->get();
        $user['bills'] = $bills;
        Mail::to($user)->send(new MailOrder($user));
    }
}

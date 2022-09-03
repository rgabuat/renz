<?php

namespace App\Console\Commands;

use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;
use Mail;

use App\Models\ArticleOrder;
use App\Models\Subscriptions;
use App\Models\Invoices;
use App\Models\User;
use App\Models\ArticleOrderInvoices;
use App\Models\SubscriptionsInvoices;

use Illuminate\Console\Command;

class SendInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendInvoice:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Monthly Invoices';

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
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user)
        {
            if($user->stripe_id != NULL)
            {
                Mail::send('email.invoiceTemplate',$user->toArray(),function($message) use($user){
                    $message->to($user->email);
                    $message->subject('Reset Password');
                });
            }
        }

    }
}

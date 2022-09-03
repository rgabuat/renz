<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\ArticleOrder;
use App\Models\Subscriptions;
use App\Models\Invoices;
use App\Models\ArticleOrderInvoices;
use App\Models\SubscriptionsInvoices;
use App\Models\User;


class fetchStripInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetchInvoice:stripe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Stripe Invoices';

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
        //fetch data from stripe api
        $users = User::all();
        
        foreach($users as $user)
        {
            $invoicesApi = $user->invoicesIncludingPending();
            /*Check if user has a subscription */
            if($invoicesApi->isNotEmpty())
            {
                foreach($invoicesApi as $inv)
                {
                    if($inv->collection_method == 'send_invoice')
                    {
                        $valid8 = Subscriptions::where('inv_stripe_id',$inv->id)->first();
                        $stripeParams = [
                            'inv_stripe_id' => $inv->id,
                            'customer' => $user->id,
                            'amount_due' => $inv->amount_due,
                            'billing_reason' => $inv->billing_reason,
                            'collection_method' => $inv->collection_method,
                            'created' => Carbon::createFromTimestamp($inv->created),
                            'due_date' => $inv->due_date != '' ? Carbon::createFromTimestamp($inv->due_date)->format('Y-m-d') : 'null',
                            'currency' => $inv->currency,
                            'hosted_invoice_url' => $inv->hosted_invoice_url,
                            'invoice_pdf' => $inv->invoice_pdf,
                            'number' => $inv->number,
                            // 'status' => $inv->status,
                        ];

                        if(!$valid8)
                        {
                            $insert = Subscriptions::create($stripeParams);
                        }
                        else 
                        {
                            $update = Subscriptions::where('inv_stripe_id',$inv->id)->update($stripeParams);
                        }
                    }
                }
            }
        }
    }
}

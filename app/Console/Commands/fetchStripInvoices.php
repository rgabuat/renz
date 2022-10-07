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
        $company = Company::all();
        
        foreach($company as $user)
        {
            $invoicesApi = $user->invoicesIncludingPending();
            /*Check if user has a subscription */
            if($invoicesApi->isNotEmpty())
            {
                foreach($invoicesApi as $invoice)
                {
                    
                        if($invoice->collection_method)
                        {
                            $valid8 = Subscriptions::where('inv_stripe_id',$invoice->id)->first();
                            $stripeParams = [
                                'inv_stripe_id' => $invoice->id,
                                'customer' => $company->id,
                                'amount_due' => $invoice->amount_due,
                                'billing_reason' => $invoice->billing_reason,
                                'collection_method' => $invoice->collection_method,
                                'created' => Carbon::createFromTimestamp($invoice->period_end)->format('Y-m-d'),
                                'due_date' => $invoice->due_date != '' ? Carbon::createFromTimestamp($invoice->due_date)->format('Y-m-d') : 'null',
                                'currency' => $invoice->currency,
                                'hosted_invoice_url' => $invoice->hosted_invoice_url,
                                'invoice_pdf' => $invoice->invoice_pdf,
                                'number' => $invoice->number,
                                'company_id' => $company->id
                                // 'status' => $inv->status,
                            ];

                            if(!$valid8)
                            {
                                $insert = Subscriptions::create($stripeParams);
                            }
                            else 
                            {
                                $update = Subscriptions::where('inv_stripe_id',$invoice->id)->update($stripeParams);
                            }
                        }

                        $subscription_due_date = Carbon::createFromTimestamp($invoice->due_date)->format('Y-m-d');
                    }
                
            }
        }
    }
}

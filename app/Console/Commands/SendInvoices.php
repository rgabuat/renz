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
use App\Models\Company;
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
        $stripe = new \Stripe\StripeClient(\config('services.stripe.secret'));
        $company = Company::all();

        foreach($company as $usr)
        {
            
            if($usr->stripe_id != NULL)
            {
                $sub_items_arr = [];
                
                //get stripe plan current start and end period
                $current_period_start = $usr->subscription('main')->asStripeSubscription()->current_period_start;
                $current_period_end = $usr->subscription('main')->asStripeSubscription()->current_period_end;
                
                echo $current_period_end;
               
                //format stripe unix time to Y-m-d format
                $period_start = Carbon::createFromTimestamp($current_period_start)->format('Y-m-d');
                $period_end = Carbon::createFromTimestamp($current_period_end)->format('Y-m-d');
    
                //get Subscription stripe_id
                // $subscription_id = $usr->subscription('main')->stripe_id;
    
                $articleOrder = ArticleOrder::where('company_id',$usr->id)->whereBetween('created_at', [$period_start,$period_end])->get();
                $subscriptions_invoices = Subscriptions::where('company_id',$usr->id)->where('created', '=', Carbon::now()->format('Y-m-d'))->get();
            
                if($usr->stripe_id != NULL)
                {
                    // get month now
                    $month_now = Carbon::now()->format('m');
                    // if(Carbon::now()->format('Y-m-d') != $current_period_end )
                    // {
                        //check if has invoice generated this month
                        $invoices = Invoices::where('created_by',$usr->id)->get();
                        if($invoices->isNotEmpty())
                        {
                            $created_invoice = Carbon::parse($invoices[0]->invoice_date_gen)->format('m');
                            if($created_invoice != $month_now)
                            {
                                return;
                            }
                        }
                        else
                        {
                            $createInv = Invoices::create([
                                'invoice_date_gen' => Carbon::now()->format('Y-m-d'),
                                'created_by' => $usr->id,
                            ]);
                    
                            $invID = $createInv->id;
                        
                            if($articleOrder->isNotEmpty())
                            {
                            
                                $inv_ords_items_arr = [];
                                foreach($articleOrder as $key => $val)
                                {
                                    $inv_ords_items_arr = [
                                        'art_ord_id' => $val['id'],
                                        'inv_id' => $invID,
                                    ];
                                    $valid8 = ArticleOrderInvoices::where('art_ord_id',$val['id'])->first();
                                    if(!$valid8)
                                    {
                                        ArticleOrderInvoices::create($inv_ords_items_arr);
                                    }
                                }
                            }
                            
                            if($subscriptions_invoices->isNotEmpty())
                            {
                                $inv_subs_items_arr = [];
                                foreach($subscriptions_invoices as $key => $val)
                                {
                                    $inv_subs_items_arr = [
                                        'subs_ord_id' => $val['id'],
                                        'inv_id' => $invID,
                                    ];
                                    $valid8 = SubscriptionsInvoices::where('subs_ord_id',$val['id'])->first();
                                    if(!$valid8)
                                    {
                                        SubscriptionsInvoices::create($inv_subs_items_arr);
                                    }
                                }
                                $sub_inv = $subscriptions_invoices->sum('amount_due');
                            }
                        // } 
                    }
                  
                }
            }

                // Mail::send('email.invoiceTemplate',$usr->toArray(),function($message) use($usr){
                //     $message->to($usr->email);
                //     $message->subject('Reset Password');
                // });
        }
    }
}

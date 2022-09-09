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
        $company = Company::all();

        foreach($company as $usr)
        {
            if($usr->stripe_id != NULL)
            {
                //check if has invoice generated this month
                $hasInvoice = Invoices::all();
                
                $createInv = Invoices::create([
                    'invoice_date_gen' => Carbon::now()->format('Y-m-d'),
                    'created_by' => $usr->id,
                ]);
    
                /*Get Invoice Id*/
                $invID = $createInv->id;
                // dd($invoicesApi);
                $subscriptions_invoices = Subscriptions::where('company_id',$usr->company_id)->where('created', '=', Carbon::now()->format('Y-m-d'))->get();
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

            

            $articleOrder = ArticleOrder::where('company_id',$usr->company_id)->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
            if($articleOrder)
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

                // Mail::send('email.invoiceTemplate',$usr->toArray(),function($message) use($usr){
                //     $message->to($usr->email);
                //     $message->subject('Reset Password');
                // });
            }
        }

    }
}

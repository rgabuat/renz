<?php

namespace App\Http\Controllers;

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


class InvoiceController extends Controller
{
    //

    public function index()
    {
       
        // dd(Carbon::createFromTimestamp()->format('Y-m-d'))
        
        $createInv = Invoices::create([
            'invoice_date_gen' => Carbon::now()->format('Y-m-d'),
            'created_by' => auth()->user()->id,
        ]);

        /*Get Invoice Id*/
        $invID = $createInv->id;
        // dd($invoicesApi);

        

            $subscriptions_invoices = Subscriptions::where('created', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
            if($subscriptions_invoices)
            {


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

            }
        

        
            
        $articleOrder = ArticleOrder::where('company_id',auth()->user()->company_id)->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
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
            // dd($inv_ords_items_arr);
            $article_ord_sum = $articleOrder->sum('price');
            $total_invoice = $sub_inv + $article_ord_sum;
        }
            
    }

        // $invoices = Invoices::where('customer',$user->id)->get();
        // return view('invoice.lists',compact('invoices'));
    
}



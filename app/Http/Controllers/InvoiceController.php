<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\Invoices;
use App\Models\ArticleOrder;

class InvoiceController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        $invoicesApi= $user->invoicesIncludingPending();
        // dd(Carbon::createFromTimestamp()->format('Y-m-d'))
        
        $subscription_inv = [];
        $articleOrd_inv = [];

        if($invoicesApi->isNotEmpty())
        {
            foreach($invoicesApi as $inv)
            {
                if($inv->collection_method == 'send_invoice')
                {
                    $valid8 = Invoices::where('inv_id',$inv->id)->first();

                    $stripeParams = [
                        'inv_id' => $inv->id,
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
                        'status' => $inv->status,
                    ];

                    if(!$valid8)
                    {
                        $insert = Invoices::create($stripeParams);
                    }
                    else 
                    {
                        $update = Invoices::where('inv_id',$inv->id)->update($stripeParams);
                    }
                }
            }

            $subscriptions_invoices = Invoices::where('created', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
            
            if($subscriptions_invoices->isNotEmpty())
            {
                $inv_subs_items_arr = [];
                foreach($subscriptions_invoices as $key => $val)
                {
                    $inv_subs_items_arr[$key] = [
                        'inv_id' => $val['inv_id'],
                        'amonut_due' => $val['amount_due'],
                        'billing_reason' => $val['billing_reason'],
                        'collection_method' => $val['collection_method'],
                        'due_date' => $val['due_date'],
                        'number' => $val['number'],
                    ];

                }
                $sub_inv = $subscriptions_invoices->sum('amount_due');
            }

            $articleOrder = ArticleOrder::where('company_id',auth()->user()->company_id)->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
            
            $inv_ords_items_arr = [];
            foreach($articleOrder as $key => $val)
            {
                $inv_ords_items_arr[$key] = [
                    'ord_id' => $val['id'],
                    'price' => $val['price'],
                    'offer' => $val['offer'],
                    'completed_at' => $val['completed_at']
                ];
            }


            dd($inv_ords_items_arr);
            $article_ord_sum = $articleOrder->sum('price');
            $total_invoice = $sub_inv + $article_ord_sum;
            
        }
        else 
        {
            echo 'no invoices';
        }
        
        // $invoices = Invoices::where('customer',$user->id)->get();
        // return view('invoice.lists',compact('invoices'));
    }
}



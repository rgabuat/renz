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
                foreach($subscriptions_invoices as $sub_inv_itms)
                {
                    $inv_itms = [
                        'inv_id' => $sub_inv_itms->inv_id ,
                        'amonut_due' => $sub_inv_itms->amount_due,
                        'billing_reason' => $sub_inv_itms->billing_reason,
                        'collection_method' => $sub_inv_itms->collection_method,
                        'due_date' => $sub_inv_itms->due_date,
                        'number' => $sub_inv_itms->number,
                    ];
                }
                $sub_inv = $subscriptions_invoices->sum('amount_due');
            }

            $articleOrder = ArticleOrder::where('company_id',auth()->user()->company_id)->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
            foreach($articleOrder as $art_ord_itms)
            {
                $ord_itms = [
                    'ord_id' => $art_ord_itms->ord_id,
                    'price' => $art_ord_itms->price,
                    'offer' => $art_ord_itms->offer,
                    'completed_at' => $art_ord_itms->completed_at
                ];
            }

            $article_ord_sum = $articleOrder->sum('price');
            $total_invoice = $sub_inv + $article_ord_sum;
            


            dd($total_invoice);

        }
        else 
        {
            echo 'no invoices';
        }
        

        // $invoices = Invoices::where('customer',$user->id)->get();
        // return view('invoice.lists',compact('invoices'));
    }
}



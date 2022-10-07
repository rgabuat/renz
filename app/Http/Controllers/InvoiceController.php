<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Illumintate\Support\Str;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;
use Barryvdh\DomPDF\Facade\Pdf;
use Mail;

use App\Models\ArticleOrder;
use App\Models\Subscriptions;
use App\Models\Invoices;
use App\Models\ArticleOrderInvoices;
use App\Models\SubscriptionsInvoices;
use App\Models\User;
use App\Models\Company;


class InvoiceController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole(['company admin']))
        {
            // $stripe = new \Stripe\StripeClient(\config('services.stripe.secret'));
            // $company = Company::find(auth()->user()->company_id);
            // $sub_items_arr = [];

            // //get stripe plan current start and end period
            // $current_period_start = $company->subscription('main')->asStripeSubscription()->current_period_start;
            // $current_period_end = $company->subscription('main')->asStripeSubscription()->current_period_end;

            // //format stripe unix time to Y-m-d format
            // $period_start = Carbon::createFromTimestamp($current_period_start)->format('Y-m-d');
            // $period_end = Carbon::createFromTimestamp($current_period_end)->format('Y-m-d');

            // //get Subscription stripe_id
            // $subscription_id = $company->subscription('main')->stripe_id;

            // $articleOrder = ArticleOrder::where('company_id',$company->id)->whereBetween('created_at', [$period_start,$period_end])->get();
            // $subscriptions_invoices = Subscriptions::where('company_id',$company->id)->where('created', '=', Carbon::now()->format('Y-m-d'))->get();
            // $stripeSubscriptionInvoices = $company->invoicesIncludingPending();
            // if($stripeSubscriptionInvoices)
            //     {
            //         foreach($stripeSubscriptionInvoices as $invoice)
            //         {
            //             if($invoice->collection_method == 'charge_automatically')
            //             {
            //                 $valid8 = Subscriptions::where('inv_stripe_id',$invoice->id)->first();
            //                 $stripeParams = [
            //                     'inv_stripe_id' => $invoice->id,
            //                     'customer' => $company->id,
            //                     'amount_due' => $invoice->amount_due,
            //                     'billing_reason' => $invoice->billing_reason,
            //                     'collection_method' => $invoice->collection_method,
            //                     'created' => Carbon::createFromTimestamp($invoice->period_end)->format('Y-m-d'),
            //                     'due_date' => $invoice->due_date != '' ? Carbon::createFromTimestamp($invoice->due_date)->format('Y-m-d') : 'null',
            //                     'currency' => $invoice->currency,
            //                     'hosted_invoice_url' => $invoice->hosted_invoice_url,
            //                     'invoice_pdf' => $invoice->invoice_pdf,
            //                     'number' => $invoice->number,
            //                     'company_id' => $company->id
            //                     // 'status' => $inv->status,
            //                 ];

            //                 if(!$valid8)
            //                 {
            //                     $insert = Subscriptions::create($stripeParams);
            //                 }
            //                 else 
            //                 {
            //                     $update = Subscriptions::where('inv_stripe_id',$invoice->id)->update($stripeParams);
            //                 }
            //             }

            //             $subscription_due_date = Carbon::createFromTimestamp($invoice->due_date)->format('Y-m-d');
            //         }
            //     }
            

            // if($company->stripe_id != NULL)
            // {
            //     // get month now
            //     $month_now = Carbon::now()->format('m');
            //     if(Carbon::now()->format('Y-m-d') == $current_period_end )
            //     {
            //         //check if has invoice generated this month
            //         $invoices = Invoices::where('created_by',$company->id)->get();
            //         if($invoices->isNotEmpty())
            //         {
            //             $created_invoice = Carbon::parse($invoices[0]->invoice_date_gen)->format('m');
            //             if($created_invoice != $month_now)
            //             {
            //                 return;
            //             }
            //         }
            //         else
            //         {
            //             $createInv = Invoices::create([
            //                 'invoice_date_gen' => Carbon::now()->format('Y-m-d'),
            //                 'created_by' => $company->id,
            //             ]);
                
            //             $invID = $createInv->id;
                    
            //             if($articleOrder->isNotEmpty())
            //             {
                        
            //                 $inv_ords_items_arr = [];
            //                 foreach($articleOrder as $key => $val)
            //                 {
            //                     $inv_ords_items_arr = [
            //                         'art_ord_id' => $val['id'],
            //                         'inv_id' => $invID,
            //                     ];
            //                     $valid8 = ArticleOrderInvoices::where('art_ord_id',$val['id'])->first();
            //                     if(!$valid8)
            //                     {
            //                         ArticleOrderInvoices::create($inv_ords_items_arr);
            //                     }
            //                 }
            //             }
                        
            //             if($subscriptions_invoices->isNotEmpty())
            //             {
            //                 $inv_subs_items_arr = [];
            //                 foreach($subscriptions_invoices as $key => $val)
            //                 {
            //                     $inv_subs_items_arr = [
            //                         'subs_ord_id' => $val['id'],
            //                         'inv_id' => $invID,
            //                     ];
            //                     $valid8 = SubscriptionsInvoices::where('subs_ord_id',$val['id'])->first();
            //                     if(!$valid8)
            //                     {
            //                         SubscriptionsInvoices::create($inv_subs_items_arr);
            //                     }
            //                 }
            //                 $sub_inv = $subscriptions_invoices->sum('amount_due');
            //             }
            //         } 
            //     }
                $invoices = Invoices::where('created_by',auth()->user()->company_id)->distinct('created_by')->get();
            // }
        }
        else 
        {
            $invoices = Invoices::all();
        }
        // $subscriptions = SubscriptionsRequests::with('user.company','plan')->whereHas('user',function ($query) { $query->where('company_id',auth()->user()->company_id);})->get();
        return view('invoice.Lists',compact('invoices'));
    }

    public function show($id)
    {
        $subsItms = SubscriptionsInvoices::where('inv_id',$id)->with('subscription_invoice')->get();
        $artOrdItms = ArticleOrderInvoices::where('inv_id',$id)->with('articleOrder')->get();
        $user_cmpny_details = Company::where('id',auth()->user()->company_id)->get();
        $invoice_details = Invoices::where('created_by',auth()->user()->id)->where('id',$id)->get();
        // $artOrdSum = $artOrdItms->sum('price');
        // $subTotalSum = $subsItms->sum('subscriptions.amount');
        // $total_amount = $artOrdSum+$subTotalSum;
        // dd($total_amount);
        
        return view('invoice.Show',compact('subsItms','artOrdItms','user_cmpny_details','invoice_details'));
    }

    public function generateInvoicePdf($id)
    {
      
        $subsItms = SubscriptionsInvoices::where('inv_id',$id)->with('subscription_invoice')->get();
        $artOrdItms = ArticleOrderInvoices::where('inv_id',$id)->with('articleOrder')->get();
        $user_cmpny_details = Company::where('id',auth()->user()->company_id)->get();
        $invoice_details = Invoices::where('created_by',1)->distinct('created_by')->get();

        // dd($invoice_details);
        $pdf = PDF::loadView('invoice.pdf-temp',compact('subsItms','artOrdItms','user_cmpny_details','invoice_details'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
    }

}



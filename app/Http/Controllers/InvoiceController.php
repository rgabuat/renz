<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
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
        // $users = User::all();
        // foreach($users as $usr)
        // {
        //     if($usr->stripe_id != NULL)
        //     {
        //         $hasInvoice = Invoices::all();
        //         $subscriptions_invoices = Subscriptions::where('created', '=', Carbon::now()->format('Y-m-d'))->get();
        //         $articleOrder = ArticleOrder::where('company_id',$usr->company_id)->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();

        //         // if(!$subscriptions_invoices || !$articleOrder->isNotEmpty())
        //         // {
        //         //     $createInv = Invoices::create([
        //         //         'invoice_date_gen' => Carbon::now()->format('Y-m-d'),
        //         //         'created_by' => $usr->id,
        //         //     ]);
    
                    
        //         // }

        //         foreach($hasInvoice as $monthly_inv)
        //         {
        //             $date = Carbon::parse($monthly_inv->invoice_date_gen);
        //             $currMonth = Carbon::now()->format('m');
        //             $invMonth = $date->format('m');
        //             if($invMonth != $currMonth)
        //             {
        //                 return 'has invoice';
        //             }
        //             else 
        //             {
        //                 $createInv = Invoices::create([
        //                     'invoice_date_gen' => Carbon::now()->format('Y-m-d'),
        //                     'created_by' => $usr->id,
        //                 ]);
        //                 /*Get Invoice Id*/
        //                 $invID = $createInv->id;
        //             }
        //         }
                

        //         if($createInv)
        //         {
    
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
        //             }

        //             $inv_ords_items_arr = [];
        //             foreach($articleOrder as $key => $val)
        //             {
        //                 $inv_ords_items_arr = [
        //                     'art_ord_id' => $val['id'],
        //                     'inv_id' => $invID,
        //                 ];
        //                 $valid8 = ArticleOrderInvoices::where('art_ord_id',$val['id'])->first();
        //                 if(!$valid8)
        //                 {
        //                     ArticleOrderInvoices::create($inv_ords_items_arr);
        //                 }
        //             }
    
        //         }

        //         // if($articleOrder)
        //         // {
                    
        //         // }

        //             // Mail::send('email.invoiceTemplate',$usr->toArray(),function($message) use($usr){
        //             //     $message->to($usr->email);
        //             //     $message->subject('Reset Password');
        //             // });
        //     }
        // }

 

        $user = auth()->user();
        $invoices = Invoices::where('created_by',auth()->user()->id)->distinct('created_by')->get();
        return view('invoice.Lists',compact('invoices'));
    }

    public function show($id)
    {
        $subsItms = SubscriptionsInvoices::where('inv_id',$id)->with('subscription')->get();
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
        $subsItms = SubscriptionsInvoices::where('inv_id',$id)->with('subscription')->get();
        $artOrdItms = ArticleOrderInvoices::where('inv_id',$id)->with('articleOrder')->get();
        $user_cmpny_details = Company::where('id',auth()->user()->company_id)->get();
        $invoice_details = Invoices::where('created_by',auth()->user()->id)->distinct('created_by')->get();
        $pdf = PDF::loadView('invoice.pdf-temp',compact('subsItms','artOrdItms','user_cmpny_details','invoice_details'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
    }

}



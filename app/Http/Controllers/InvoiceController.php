<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\Invoices;

class InvoiceController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        $invoicesApi= $user->invoices();

        // dd($invoicesApi);

        // dd(Carbon::createFromTimestamp()->format('Y-m-d'))

        if($invoicesApi->isNotEmpty())
        {
            foreach($invoicesApi as $inv)
            {
                $valid8 = Invoices::where('inv_id',$inv->id)->first();
                if(!$valid8)
                {
                    $insert = Invoices::create([
                        'inv_id' => $inv->id,
                        'customer' => $user->id,
                        'amount_due' => $inv->amount_due,
                        'billing_reason' => $inv->billing_reason,
                        'collection_method' => $inv->collection_method,
                        'created' => Carbon::createFromTimestamp($inv->created),
                        'due_date' => $inv->due_date != '' ? Carbon::createFromTimestamp($inv->due_date)->format('Y-m-d') : 'null' ,
                        'currency' => $inv->currency,
                        'hosted_invoice_url' => $inv->hosted_invoice_url,
                        'invoice_pdf' => $inv->invoice_pdf,
                        'number' => $inv->number,
                        'status' => $inv->status,
                    ]);
                }
            }
        }
        else 
        {
            echo 'no invoices';
        }
        

        $invoices = Invoices::where('customer',$user->id)->get();
        return view('invoice.lists',compact('invoices'));
    }
}



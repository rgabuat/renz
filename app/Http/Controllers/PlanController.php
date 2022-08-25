<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\PlanModel; 

class PlanController extends Controller
{
    public function index()
    {
        $packages = PlanModel::with('user')->get();
        return view('packages.Lists',compact('packages'));
    }

    public function create()
    {
        return view('packages.Create');
    }

    public function store(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $this->validate($request, [
            'name' => 'required|max:255|unique:tbl_package,name',
            'price' => 'required|max:255',
            'credits' => 'required|max:255',
            'payment_method' => 'required|max:255',
            'duration' => 'required|max:255',
            'interval_count' => 'required|max:255',

        ]);

        $plan = Plan::create([
            'amount' => $request->price,
            'currency' => 'gbp',
            'interval' => $request->duration,
            'interval_count' => $request->interval_count,
            'product' => [
                'name' => $request->name,
            ],
            'metadata' => [
                'description' => $request->description,
                'credits' => $request->credits,
                'payment_method' => $request->payment_method,
            ]
        ]);

        $package = PlanModel::create([
            'plan_id' => $plan->id,
            'name' => $request->name,
            'amount' => $plan->amount,
            'billing_method' => $plan->interval,
            'interval_count' => $plan->interval_count,
            'currency' => $plan->currency,
            'description' => $plan->metadata->description,
            'credits' => $plan->metadata->credits,
            'payment_method' => $plan->metadata->payment_method,
            'created_by' => Auth()->user()->id,
        ]);

        if($package)
        {
            return redirect()->back()->with('status','New Plan Created');
        }
        else 
        {
            return redirect()->back()->with('status','Something went wrong!');
        }

    }

    public function checkout($planId)
    {
        $plan = PlanModel::where('plan_id',$planId)->first();

        if(!$plan)
        {
            return redirect()->back()->with('status','Plan not Found');
        }

        if($plan->payment_method == 'invoice')
        {
            $user = auth()->user();
            $user->createOrGetStripeCustomer();
            $resp = $user->newSubscription('default', $plan->plan_id)->createAndSendInvoice();
            
            

            if($resp)
            {
                return redirect()->back()->with('status','Invoice Sent to '.auth()->user()->first_name);
            }
        }
        else 
        {
            return view('packages.Checkout',[
                'plan' => $plan,
                'intent' => auth()->user()->createSetupIntent(),
            ]);
            
        }
    }

    public function processPlan(Request $request)
    {

        
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        

        $paymentMethod = $request->payment_method;
        $plan = $request->plan_id;

        if($paymentMethod != null)
        {
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }
        
        $resp = $user->newSubscription(
            'default', $plan
        )->create($paymentMethod != null ? $paymentMethod->id : '',[
            'email' => $user->email
        ]); 
        

        // if($resp)
        // {
        //     return redirect()->with('status','New Package Created');
        // }

    }
}
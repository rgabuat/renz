<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\PlanModel; 
use App\Models\Subscriptions; 
use App\Models\SubscriptionsRequests; 

class PlanController extends Controller
{
    public function index()
    {
        // ** key to get all plans/products
        $stripe = new \Stripe\StripeClient(\config('services.stripe.secret'));
        $products = $stripe->products->all(['limit' => 100]);

        if($products->data != '')
        {
            foreach($products as $product)
            {
               $prices = $stripe->prices->all(['product'=> $product->id]);
               foreach($prices->data as $price)
               {
                    $valid8 = PlanModel::where('plan_id',$price->id)->first();
                    
                    $prodPrice = [
                        'plan_id' => $price->id,
                        'name' => $product->name,
                        'amount' => $price->unit_amount,
                        'billing_method' => $price->recurring->interval,
                        'interval_count' => $price->recurring->interval_count,
                        'currency' => $price->currency,
                        'credits' => $price->metadata->credits,
                        'payment_method' => $price->metadata->payment_method,
                        'created_by' => auth()->user()->id,
                    ];
                    
                    if(!$valid8)
                    {
                        $package = PlanModel::create($prodPrice);
                    }
                    else 
                    {
                        $update = PlanModel::where('plan_id',$price->id)->update($prodPrice);
                    }
                   
               }
    
            }
        }
        
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
        $start_date = Carbon::now();



        if(!$plan)
        {
            return redirect()->back()->with('status','Plan not Found');
        }

        if($plan->payment_method == 'invoice')
        {
            $anchor = Carbon::parse('first day of next month');
            $user = auth()->user();
            $cus_id = $user->createOrGetStripeCustomer();

            // dd($cus_id->id);
            // $resp = $user->newSubscription('default', $plan->plan_id)
                                        // ->anchorBillingCycleOn($anchor->startOfDay())
                                        // ->backdateStartDate($start_date)
                                        // ->createAndSendInvoice();
            if($cus_id)
            {
                $insert_request = [
                    'cus_uid' => auth()->user()->id,
                    'cus_sid' => $user->stripe_id,
                    'plan_id' => $plan->id,
                    'status' => 0
                ]; 

                if($insert_request)
                {
                    SubscriptionsRequests::create($insert_request);
                    return redirect()->back()->with('status','Subscription request sent');
                }
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
        $start_date = Carbon::now();
        $anchor = Carbon::parse('first day of next month');
        $paymentMethod = $request->payment_method;
        $plan = $request->plan_id;

        if($paymentMethod != null)
        {
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }
        
        $resp = $user->newSubscription('default', $plan)
                            ->anchorBillingCycleOn($anchor->startOfDay())
                            ->create($paymentMethod != null ? $paymentMethod->id : '',['email' => $user->email]);
                            
        if($resp)
        {
            return redirect()->back()->with('status','Payment Success');
        }

    }
}

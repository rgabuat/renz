<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\Subscriptions;
use App\Models\Package;
use App\Models\User;
use App\Models\Company;
use App\Models\SubscriptionsRequests; 

class SubscriptionsController extends Controller
{
    //
    public function package_requests()
    {
        $requests = SubscriptionsRequests::with('user.company','plan')->get();
        return view('packages.requests',compact('requests'));
    }

    public function approve(Request $request,$rid,$cid)
    {

        $stripe = new \Stripe\StripeClient(\config('services.stripe.secret'));
    
        $request = SubscriptionsRequests::with('plan')->where('id',$request->subs_id)->get();
        $planId = $request[0]['plan'][0]['plan_id'];
        $company = Company::where('id',$cid)->first();

    
        if($company->stripe_id)
        {
            $subscriptionItems = $company->subscriptions;
            $credits = 0;
            foreach($subscriptionItems as $subscriptionItem)
            {
                $credits += $subscriptionItem->plan->credits;
            }

            $respUpdate = Company::where('id',$company->id)->update(['avail_credits' => $credits]);
            if($respUpdate)
            {
                $resp = $company->newSubscription('default', $planId)
                // ->anchorBillingCycleOn($anchor->startOfDay())
                // ->backdateStartDate($start_date)
                ->createAndSendInvoice();
                if($resp)
                {
                    $update = SubscriptionsRequests::where('id',$rid)->update(['status' => 1]);
                    return redirect()->back()->with('status','Subscription Approved , Invoice Sent');
                }
                else 
                {
                    return redirect()->back()->with('status','Subscription Err');
                }
            }
        }

        exit;
        // $has_current = Company::where('id',$cid)->where('package_id','!=','null')->get();
        // $subsciption = str_replace(' ', '', $package[0]['duration']);
        // $credits = str_replace(' ', '', $package[0]['credits']);
        exit;

        if(!$has_current->isEmpty())
        {
            $current_sub = Carbon::createFromFormat('Y-m-d H:i:s',$has_current[0]->expires_at)->addMonths($subsciption);
            $current_credits = $has_current[0]->avail_credits + $credits;

            $params = [
                'started_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addMonths($subsciption),
                'status' => 1
            ];

            $update_sub = Subscriptions::where('id',$rid)->update($params);
            if($update_sub)
            {
                $subscription_update = [
                    'expires_at' => $current_sub,
                    'avail_credits' => $current_credits,
                ];
                $update = Company::where('id',$has_current[0]->id)->update($subscription_update);
                return redirect()->back()->with('status','Subscription Approved');
            }

        }
        else 
        {
            if($package)
            {
                $subs_param = [
                    'started_at' => Carbon::now(),
                    'expires_at' => Carbon::now()->addMonths($subsciption),
                    'status' => 1,
                ];

                $update = Subscriptions::where('id',$rid)->update($subs_param);

                if($update)
                {
                    $params = [
                        'package_id' => $request->subs_id,
                        'avail_credits' => $package[0]['credits'],
                        'started_at' => Carbon::now(),
                        'expires_at' => Carbon::now()->addMonths($subsciption),
                    ];
                    $update = Company::where('id',$cid)->update($params);
                }
                return redirect()->back()->with('status','Subscription Approved');
            }
            else 
            {
                return redirect()->back()->with('status','Something went wrong!');
            }
        }

    }


    public function show_sub()
    {
        $subscriptions = Subscriptions::where('user_id',auth()->user()->id)->where('status',1)->where('expires_at !=','null');
        
        if($subscriptions)
        {
            return view('profile.ViewProfile',compact('subscriptions'));
        }
    }

    public function my_subscriptions()
    {
        $auth = auth()->user()->company_id;
        $subscriptions = SubscriptionsRequests::with('user.company','plan')->whereHas('user',function ($query) { $query->where('company_id',auth()->user()->company_id);})->get();
        if($subscriptions)
        {
            return view('packages.MySubscriptions',compact('subscriptions'));
        }
    }

    public function cancel(Request $request,$sid)
    {
        $cid = auth()->user()->company_id;
        $cancelSub = Subscriptions::with('user.company','package')->where('company_id',$cid)->get();

        $subsciption =  $request->sub_duration;
        $credits = $request->sub_credits;

        $package = Subscriptions::where('id',$sid)->get();

        $has_current = Company::where('id',$cid)->where('package_id','!=','null')->get();
        $current_sub = Carbon::createFromFormat('Y-m-d H:i:s',$has_current[0]->expires_at)->subMonths($subsciption);
        $current_credits = $has_current[0]->avail_credits - $credits;

        $updateCancel = Subscriptions::where('id',$sid)->update(['status' => 2]);

        if($updateCancel)
        {
            $subscription_update = [
                'expires_at' => $current_sub,
                'avail_credits' => $current_credits,
            ];
            $update = Company::where('id',$cid)->update($subscription_update);
        }

        return redirect()->back()->with('status','Subscription Canceled');
    }
    
}

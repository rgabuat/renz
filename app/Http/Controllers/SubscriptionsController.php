<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Subscriptions;
use App\Models\Package;
use App\Models\User;

class SubscriptionsController extends Controller
{
    //
    public function package_requests()
    {
        $requests = Subscriptions::with('user.company','package')->where('status',0)->get();
        return view('packages.requests',compact('requests'));
    }

    public function approve($pid,$uid)
    {
        $package = Package::where('id',$pid)->get();

        $has_current = Subscriptions::where('user_id',$uid)->where('status',1)->get();
        $subsciption = str_replace(' ', '', $package[0]['duration']);
        $credits = str_replace(' ', '', $package[0]['credits']);
        
        if($has_current)
        {
            $current_sub = Carbon::createFromFormat('Y-m-d H:i:s', $has_current[0]->expires_at)->addMonths($subsciption);
            $current_credits = $has_current[0]->avail_credits + $credits;

            $sub_status = [
                'status' => 1
            ];

            $update_sub = Subscriptions::where('package_id',$pid)->update($sub_status);
           
            if($update_sub)
            {
                $subscription_update = [
                    'expires_at' => $current_sub,
                    'avail_credits' => $current_credits,
                ];
                $update = Subscriptions::where('id',$has_current[0]->id)->update($subscription_update);
                return redirect()->back()->with('status','Subscription Approved');
            }

        }
        else 
        {
            $approve_date = Carbon::now();

            if($package)
            {
                $subscription_update = [
                'started_at' => $approve_date,
                'expires_at' => Carbon::now()->addMonths($subsciption),
                'status' => 1,
            ];
    
            $update = Subscriptions::where('id',$pid)->update($subscription_update);
    
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
        
        dd($subsciptions);

        if($subscriptions)
        {
            return view('profile.ViewProfile',compact('subscriptions'));
        }
    }

    public function my_subscriptions()
    {
        $auth = auth()->user()->id;
        
        $subscriptions = Subscriptions::with('user.company','package')->where('user_id',$auth)->get();

        if($subscriptions)
        {
            return view('packages.MySubscriptions',compact('subscriptions'));
        }

    }
    
}

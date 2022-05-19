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

    public function approve($pid)
    {
        $package = Package::where('id',$pid)->get();
        $approve_date = Carbon::now();
        $subsciption = str_replace(' ', '', $package[0]['duration']);

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


    public function show_sub()
    {
        $subscriptions = Subscriptions::where('user_id',auth()->user()->id)->where('status',1);
        
        if($subscriptions)
        {
            return view('profile.ViewProfile',compact('subscriptions'));
        }
    }
    
}

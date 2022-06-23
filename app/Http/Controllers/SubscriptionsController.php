<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Subscriptions;
use App\Models\Package;
use App\Models\User;
use App\Models\Company;

class SubscriptionsController extends Controller
{
    //
    public function package_requests()
    {
        $requests = Subscriptions::with('user.company','package')->get();
        return view('packages.requests',compact('requests'));
    }

    public function approve(Request $request,$rid,$cid)
    {
        $package = Package::where('id',$request->package_id)->get();

        $has_current = Company::where('id',$cid)->where('package_id','!=','null')->get();
        $subsciption = str_replace(' ', '', $package[0]['duration']);
        $credits = str_replace(' ', '', $package[0]['credits']);

        
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
        
        dd($subsciptions);

        if($subscriptions)
        {
            return view('profile.ViewProfile',compact('subscriptions'));
        }
    }

    public function my_subscriptions()
    {
        $auth = auth()->user()->company_id;

        $currSub = Company::where('id',$auth)->get();
        
        $subscriptions = Subscriptions::with('user.company','package')->where('company_id',$auth)->get();

        if($subscriptions)
        {
            return view('packages.MySubscriptions',compact('subscriptions','currSub'));
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use \Stripe\Stripe;
use \Stripe\Plan;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Subscriptions;
use App\Models\Company;


use App\Models\PlanModel; 


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $roles = Role::all();
        $sub_items_arr = [];
        $credits = 0;
        if(auth()->user()->hasRole(['company admin','company user']))
        {
            $stripe = new \Stripe\StripeClient(\config('services.stripe.secret'));
            $company = Company::find(auth()->user()->company_id);
            $credits = $company->avail_credits;
            if($company->stripe_id)
            {
                $subscriptionItems = $company->subscriptions;    
                $subscription = $stripe->subscriptions->all(['customer' => $company->stripe_id]);  
                
                foreach($subscriptionItems as $key => $value)
                {
                    $items = $stripe->subscriptions->retrieve($value->stripe_id); 
                    
                    $sub_items_arr[$key] = [
                        'id' => $items->id,
                        'credits' => $value->plan->credits,
                        'amount' => $value->plan->amount,
                        'current_period_start' =>  Carbon::createFromTimestamp($items->current_period_start)->format('Y-m-d'),
                        'current_period_end' => Carbon::createFromTimestamp($items->current_period_end)->format('Y-m-d')
                    ];
                }
            }
        }
    
        // $subscriptions = Subscriptions::with('package')->where('user_id',auth()->user()->id)->where('status',1)->get()->where('expires_at','!=','null');
        // $subscriptions = Company::with('subscription.package')->where('package_id','!=','null')->where('id',auth()->user()->company_id)->get();
        return view('admin.profile.ViewProfile', compact('roles','sub_items_arr','credits'));
    }

    public function edit()
    {
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $roles = Role::all();
        }
        else 
        {
            $roles = Role::whereNotIn('name', ['system admin','system editor','system user'])->get();
        }
        return view('admin.profile.EditProfile', compact('roles'));
    }

    public function update(Request $request,$uid)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if(auth()->user()->hasRole('company admin|company user'))
        {
            $param = [
                'company_name' => $request->company
            ];
        }

        if($request->has('image'))
        {
            $destinationPath = 'excels/uploads';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('image')->storeAs($destinationPath,$file_name,'public');
            $image = $path;

            $param = [
                'profile_image' =>  $image
            ];

            $update_profile = User::where('id',$uid)->update($param);
            return redirect()->back()->with('status', 'Profile Successfully Updated');
        }

        $param = [
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'email' => $request->email,
        ];

        $update_profile = User::where('id',$uid)->update($param);
        if($update_profile)
        {
            $user = auth()->user();
            $options = [
                'email' => $request->email
            ];
            
            $stripeCustomer = $user->updateStripeCustomer($options);
            return redirect()->back()->with('status', 'Profile Successfully Update');
        }
    }
    
}

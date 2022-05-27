<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Subscriptions;
use App\Models\Company;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $roles = Role::all();
        // $subscriptions = Subscriptions::with('package')->where('user_id',auth()->user()->id)->where('status',1)->get()->where('expires_at','!=','null');

        $subscriptions = Company::with('package')->where('package_id','!=','null')->get();
        return view('admin.profile.ViewProfile', compact('roles','subscriptions'));
       
    }

    public function edit()
    {

        $roles = Role::all();
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
            return redirect()->back()->with('status', 'Profile Successfully Update');
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
            return redirect()->back()->with('status', 'Profile Successfully Update');
        }

        
    }
    
}

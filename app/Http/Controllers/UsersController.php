<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if(auth()->user()->hasRole(['system admin|system editor|system user']))
        {
            $users = User::all();
        }
        elseif(auth()->user()->hasRole(['company admin']))
        {
            $users = Company::where('created_by_admin',auth()->user()->id)->with('admin_sub_accounts')->get();
        }
        else 
        {
            $users = Company::where('created_by_owner',auth()->user()->id)->with('user_sub_accounts')->get();
        }
        return view('admin.users.UsersList', compact('users'));
    }


    public function sub_accounts()
    {
        if(auth()->user()->hasRole(['system admin|system editor|system user']))
        {
            $users = User::all();
        }
        elseif(auth()->user()->hasRole(['company admin']))
        {
            $users = Company::where('created_by_admin',auth()->user()->id)->with('admin_sub_accounts')->get();
        }
        else 
        {
            $users = Company::where('created_by_owner',auth()->user()->id)->with('user_sub_accounts')->get();
        }
        return view('admin.users.UserSubAccounts', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
            'role' => 'required',
        ]);


        $user = User::create([
            'company' => $request->company,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $user->assignRole($request->role);
        return redirect()->back()->with('status','Account Creation Success');
    }

    public function edit($uid)
    {
        $user = User::where('id',$uid)->first();
        $roles = Role::whereNotIn('name', ['company admin','company user'])->get();
        return view('admin.users.UserEdit', compact('user','roles'));
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
        ]);


            $user_data = [
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            
            $user_update = User::where('id',$uid)->update($user_data);
            if($user_update)
            {
                return redirect()->back()->with('status','Update Success');
            }

        // return redirect()->back()->with('status','Update Success');
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['company admin','company user'])->get();
        return view('admin.users.UserAdd',compact('roles'));
    }

    public function activateUser($uid)
    {
        $response = User::where('id',$uid)->update(['is_activated' => 1]);
        if($response)
        {
            return redirect()->back()->with('status','User Activated');
        }
    }

    public function deactivateUser($uid)
    {
        $response = User::where('id',$uid)->update(['is_activated' => 0]);
        if($response)
        {
            return redirect()->back()->with('status','User Deactivated');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $users = User::where('role','system admin')->orWhere('role','system editor')->orWhere('role','system user')->get();
        }
        elseif(auth()->user()->hasRole(['company admin','company user']))
        {
            $company = User::where('id',auth()->user()->id)->with('company')->get();
            $comp_id = $company[0]['company'][0]['id'];
            $users = User::where('company_id',$comp_id)->get();
        }
        // else 
        // {
        //     $users = Company::where('created_by_owner',auth()->user()->id)->with('user_sub_accounts')->get();
        // }
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required',
        ]);


        $user = User::create([
            'company_id' => 0,
            'first_name' => Str::ucfirst(Str::lower($request->firstname)),
            'last_name' => Str::ucfirst(Str::lower($request->lastname)),
            'address' => Str::ucfirst(Str::lower($request->address)),
            'phone_number' => $request->phone_number,
            'username' => Str::lower($request->username),
            'email' => Str::lower($request->email),
            'password' => Hash::make('default123'),
            'is_activated' => 1,
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
            'username' => 'required|max:255|unique:users,username,'.$uid,
            'email' => 'required|email|max:255|unique:users,email,'.$uid,
            'role' => 'required',
        ]);

            $user_data = [
                'first_name' => Str::ucfirst(Str::lower($request->firstname)),
                'last_name' => Str::ucfirst(Str::lower($request->lastname)),
                'address' => Str::ucfirst(Str::lower($request->address)),
                'phone_number' => $request->phone_number,
                'username' => Str::lower($request->username),
                'email' => Str::lower($request->email),
                'role' => $request->role,
            ];
            
            $user = User::where('id',$uid)->first();
            $resp = $user->update($user_data);
            $user->syncRoles($request->role);
            if($resp)
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

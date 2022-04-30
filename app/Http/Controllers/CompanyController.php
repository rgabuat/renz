<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
       
        if(auth()->user()->hasRole(['system admin','system editor']))
        {
            $companies = Company::with('admin_sub_accounts','user_sub_accounts')->get();
        }
        elseif(auth()->user()->hasRole(['company admin']))
        {
            $company = User::where('id',auth()->user()->id)->with('company')->get();
            $comp_id = $company[0]['company'][0]['id'];
            $companies = User::where('company_id',$comp_id)->get();

            // $companies = Company::where('created_by_admin',auth()->user()->id)->with('admin_sub_accounts')->get();
        }
        else
        {
            $companies = Company::where('created_by_owner',auth()->user()->id)->with('user_sub_accounts')->get();
        }
        
        return view('company.CompanyList',compact('companies'));
    }

    public function sub_accounts()
    {
        // if(auth()->user()->hasRole(['company admin']))
        // {
        //     $companies = Company::where('created_by_admin',auth()->user()->id)->with('admin_sub_accounts')->get();
        // }
        // else
        // {
        //     $companies = Company::where('created_by_owner',auth()->user()->id)->with('user_sub_accounts')->get();
        // }
        $company = User::where('id',auth()->user()->id)->with('company')->get();
        $comp_id = $company[0]['company'][0]['id'];
        $companies = User::where('company_id',$comp_id)->get();
        return view('company.CompanySubAccounts',compact('companies'));
    }

    public function company_accounts($id)
    {
        $companies = User::where('company_id',$id)->get();
        return view('company.CompanySubAccounts',compact('companies'));
    }

    public function create()
    {
        
        $company = User::where('id',auth()->user()->id)->with('company')->get();

        $company_details = [
            'comp_id' => $company[0]['company'][0]['id'],
            'company_name' => $company[0]['company'][0]['company_name'],
            'reg_num' => $company[0]['company'][0]['reg_number'],
        ];

        $roles = Role::whereNotIn('name', ['system admin', 'system editor','system user'])->get();

        return view('company.CompanyAdd',compact('roles','company_details'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|max:255',
            'firstname' => 'required|unique:users,first_name|max:255',
            'lastname' => 'required|unique:users,last_name|max:255',
            'address' => 'required|max:255',
            'reg_number' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'role' => 'required',
        ]);
        
        $comp_id = $request->comp_id;
        $cid =Company::find($comp_id);

        if($cid)
        {
            $user = User::create([
                'company_id' => $comp_id,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make('default123'),
                'role' => $request->role,
                'is_activated' => 1
            ]);
            $user->assignRole($user->role);
            // Company::where('id',$comp_id)->update(['created_by_admin' => auth()->user()->id]);
            return redirect()->back()->with('status','Account Creation Success');
        }
    }

    public function edit($uid)
    {
        $company = Company::where('id',$uid)->with('admin_sub_accounts','user_sub_accounts')->first();
        $roles = Role::whereNotIn('name', ['system admin', 'system editor','system user'])->get();
        return view('company.CompanyEdit', compact('company','roles'));
    }

    public function update(Request $request,$uid)
    {   

            $this->validate($request, [
                'company' => 'required|max:255',
                'reg_number' => 'required|max:255',
            ]);

            $company_data = [
                'company_name' => $request->company,
                'reg_number' => $request->reg_number,
            ];

            $company_update = Company::where('id',$uid)->update($company_data);
            if($company_update)
            {
                return redirect()->back()->with('status','Update Success');
            }

        // return redirect()->back()->with('status','Update Success');
    }

    public function activateUser($uid)
    {
        $response = Company::where('id',$uid)->update(['is_activated' => 1]);
        if($response)
        {
            return redirect()->back()->with('status','User Activated');
        }
    }

    public function deactivateUser($uid)
    {
        $response = Company::where('id',$uid)->update(['is_activated' => 0]);
        if($response)
        {
            return redirect()->back()->with('status','User Deactivated');
        }
    }
}

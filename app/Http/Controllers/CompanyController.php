<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

use App\Models\Company;
use App\Models\User;


class CompanyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
       
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $companies = Company::with('admin_sub_accounts','user_sub_accounts')->get();
        }
        elseif(auth()->user()->hasRole(['company admin']))
        {
            $company = User::where('id',auth()->user()->id)->with('company')->get();
            $comp_id = $company[0]['company'][0]['id'];
            $companies = User::where('company_id',$comp_id)->get();
        }
        else
        {
            $companies = Company::where('created_by_owner',auth()->user()->id)->with('user_sub_accounts')->get();
        }

        
        
        return view('company.CompanyList',compact('companies'));
    }

    public function sub_accounts()
    {
        $company = User::where('id',auth()->user()->id)->with('company')->get();
        $comp_id = $company[0]['company'][0]['id'];
        $companies = User::where('company_id',$comp_id)->get();

        return view('company.CompanySubAccounts',compact('companies'));
    }

    public function sub_accounts_edit($uid)
    {
        $user = User::where('id',$uid)->first();
        $roles = Role::whereNotIn('name',['system admin','system editor','system user'] )->get();
        return view('company.CompanySubAccountsEdit', compact('user','roles'));
    }

    public function sub_accounts_show($uid)
    {
        $user = User::where('id',$uid)->first();
        $roles = Role::whereNotIn('name',['system admin','system editor','system user'] )->get();
        return view('company.CompanySubAccountsShow', compact('user','roles'));
    }

    public function company_accounts($cname,$id)
    {
        $companies = User::where('company_id',$id)->get();
        return view('company.CompanySubAccounts',compact('companies'));
    }

    public function create()
    {
        
        $company = User::where('id',auth()->user()->id)->with('company')->get();
        $roles = Role::whereNotIn('name', ['system admin', 'system editor','system user'])->get();
        return view('company.CompanyAdd',compact('roles'));
    }

    public function store(Request $request)
    {

      
        $this->validate($request, [
             'company' => 'required|unique:company,company_name|max:255',
            'firstname' => 'required|unique:users,first_name|max:255',
            'lastname' => 'required|unique:users,last_name|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'company_phone' => 'required|max:255',
            'reg_number' =>  'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'role' => 'required',
        ]);

            if(auth()->user()->hasRole(['system admin','system editor']))
            {
                $company = Company::create([
                    'company_name' => Str::ucfirst(Str::lower($request->company)),
                    'reg_number' => $request->reg_number,
                    'email' => $request->email,
                    'created_by_owner' => 'null',
                    'created_by_admin' => 'null',
                    'status' => 'pending',
                    'city' => Str::ucfirst(Str::lower($request->city)),
                    'state' => Str::ucfirst(Str::lower($request->state)),
                    'country' => Str::ucfirst(Str::lower($request->country)),
                    'zip' => $request->zip,
                    'phone_number' => $request->company_phone,
                ]);
                if($company)
                {
                    $company_id = $company->id;
                    $reg_num = $company->reg_num;
                }
            }
            else 
            {
                $user_comp = User::where('id',auth()->user()->id)->with('company')->get();
                $company_id =  $user_comp[0]['company'][0]['id'];
                $reg_num = $user_comp[0]['company'][0]['reg_num'];
            }

            $user = User::create([
                'company_id' => $company_id,
                'first_name' => Str::ucfirst(Str::lower($request->firstname)),
                'last_name' => Str::ucfirst(Str::lower($request->lastname)),
                'address' => Str::ucfirst(Str::lower($request->address)),
                'reg_number' => $reg_num,
                'phone_number' => $request->phone_number,
                'username' => Str::lower($request->username),
                'email' => Str::lower($request->email),
                'password' => Hash::make('default123'),
                'is_activated' => 1,
                'role' => $request->role,
            ]);

            
            $user->assignRole($request->role);
            $user = company::where('id',$company_id)->update(['created_by_admin' => auth()->user()->id]);
            // $message = ['success' => 'Account Creation Success'];
        
            return redirect()->back()->with('success','Account Creation Success');
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
                'company' => 'required|max:255|unique:company,company_name,'.$uid,
                'reg_number' => 'required|max:255',
                'city' => 'required|max:255',
                'state' => 'required|max:255',
                'country' => 'required|max:255',
                'zip' => 'required|min:4|max:5',
                'phone' => 'required|max:255',
            ]);

            $company_data = [
                'company_name' => Str::ucfirst(Str::lower($request->company)),
                'reg_number' => $request->reg_number,
                'city' => Str::ucfirst(Str::lower($request->city)),
                'state' => Str::ucfirst(Str::lower($request->state)),
                'country' => Str::ucfirst(Str::lower($request->country)),
                'zip' => $request->zip,
                'phone_number' => $request->phone,
            ];

            $company_update = Company::where('id',$uid)->update($company_data);
            if($company_update)
            {
                return redirect()->back()->with('success','Company successfully updated');
            }

        // return redirect()->back()->with('status','Update Success');
    }

    public function update_user(Request $request,$uid)
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
                return redirect()->back()->with('success','User Successfully Updated');
            }
    }

    public function details()
    {
        $company = Company::where('id',auth()->user()->company_id)->first();
        return view('company.CompanyEdit', compact('company'));
    }

    public function company_details($cid)
    {
        if($cid != '')
        {
            $compDetails = Company::where('id',$cid)->get();
            return view('company.CompanyShow', compact('compDetails'));
        }
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

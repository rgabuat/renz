<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Company;
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
        $companies = Company::all();
        return view('company.CompanyList',compact('companies'));
    }

    public function show()
    {

    }

    public function create()
    {
        $user = auth()->user();
        // if($user->hasRole(['system admin','system editor']))
        // {
        //     $roles = Role::all();
        // }
        // else 
        // {
            $roles = Role::whereNotIn('name', ['system admin', 'system editor','system user'])->get();
        // }
        return view('company.CompanyAdd',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'reg_number' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
            'role' => 'required',
        ]);


        $company = Company::create([
            'company' => $request->company,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'address' => $request->address,
            'reg_number' => $request->reg_number,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $company->assignRole($request->role);
        return redirect()->back()->with('status','Account Creation Success');
    }

    public function edit($uid)
    {
        $company = Company::where('id',$uid)->with('roles')->first();
        $roles = Role::whereNotIn('name', ['system admin', 'system editor','system user'])->get();
        return view('company.CompanyEdit', compact('company','roles'));
    }

    public function update(Request $request,$uid)
    {   

            $this->validate($request, [
                'company' => 'required|max:255',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'address' => 'required|max:255',
                'reg_number' => 'required|max:255',
                'phone_number' => 'required|max:255',
                'username' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            $company_data = [
                'company' => $request->company,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'address' => $request->address,
                'reg_number' => $request->reg_number,
                'phone_number' => $request->phone_number,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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

<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $captchaResult = $request->captchaResult;
        $captcha = md5($request->captcha);
        
        $this->validate($request, [
            'company' => 'required|unique:company,company_name|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'reg_number' => 'required|unique:company,reg_number|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|unique:users,email|unique:company,email|email|max:255',
            'password' => 'required|confirmed',
            'captcha' => 'required',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zip' => 'required|min:4|max:5',
        ]);

        if($captcha == $captchaResult)
        {
                $req = $request->has('role');
                if($req)
                {
                    $role = $request->role;
                }
                else 
                {
                    $role = 'company admin';
                }
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
                ]);
                
                if($company)
                {
                    // $comp_lastId = $company->id
                    $user = User::create([
                        'company_id' => $company->id,
                        'first_name' => Str::ucfirst(Str::lower($request->firstname)),
                        'last_name' => Str::ucfirst(Str::lower($request->lastname)),
                        'address' => Str::ucfirst(Str::lower($request->lastname)),
                        'reg_number' => $request->reg_number,
                        'phone_number' => $request->phone_number,
                        'username' => Str::lower($request->username),
                        'email' => Str::lower($request->email),
                        'password' => Hash::make($request->password),
                        'role' => $role,
                    ]);
                    $user->assignRole($role);
                    $user = company::where('id',$company->id)->update(['created_by_owner' => $user->id]);


                    $message = ['success' => 'Account Registration Success'];
                }
        }
        else 
        {
            $message = ['error' => 'Invalid Captcha'];
            // return back()->with('error','Invalid Captcha');
        }

        return back()->with($message);
    }
}

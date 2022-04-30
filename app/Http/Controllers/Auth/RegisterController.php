<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // dd($request->only('email', 'password'));

        $captchaResult = $request->captchaResult;
        $captcha = md5($request->captcha);
        
        $this->validate($request, [
            'company' => 'required|unique:company,company_name|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'reg_number' => 'required|unique:company,reg_number|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'password' => 'required|confirmed',
            'captcha' => 'required'
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
                    $role = 'company user';
                }
                $company = Company::create([
                    'company_name' => $request->company,
                    'reg_number' => $request->reg_number,
                    'created_by_owner' => 'null',
                    'created_by_admin' => 'null',
                    'status' => 'pending',
                ]);
                
                if($company)
                {
                    // $comp_lastId = $company->id
                    $user = User::create([
                        'company_id' => $company->id,
                        'first_name' => $request->firstname,
                        'last_name' => $request->lastname,
                        'address' => $request->address,
                        'reg_number' => $request->reg_number,
                        'phone_number' => $request->phone_number,
                        'username' => $request->username,
                        'email' => $request->email,
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

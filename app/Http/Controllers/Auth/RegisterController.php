<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyUsers;
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
            'company' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'required|max:255',
            'reg_number' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
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
                        'phone_number' => $request->phone_number,
                    ]);
                    $last_id = $company->id;

                    if($last_id)
                    {

                        $company->status == 'pending'? $status = '0' : $status = '1';

                        $user = User::create([
                            'company_id' => $last_id,
                            'first_name' => $request->firstname,
                            'last_name' => $request->lastname,
                            'address' => $request->address,
                            'phone_number' => $request->phone_number,
                            'username' => $request->username,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'role' => $role,
                            'is_activated' => $status
                        ]);
                        $user->assignRole($role);

                        if($user->is_activated == '0' && $user->role == 'company user')
                        {
                            Company::where('id',$last_id)->update(['created_by_owner' => $user->id]);
                        }
                        else 
                        {
                            Company::where('id',$last_id)->update(['created_by_admin' => $user->id]);
                        }

                    }
                    else 
                    {
                        $message = ['error' => 'Something went wrong . Please try again.'];
                    }
                    


               
            // return back()->with('success', 'Account Registration Success');
            $message = ['success' => 'Account Registration Success'];
        }
        else 
        {
            $message = ['error' => 'Invalid Captcha'];
            // return back()->with('error','Invalid Captcha');
        }

        return back()->with($message);
    }
}

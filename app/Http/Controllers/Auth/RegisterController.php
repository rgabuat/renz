<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
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
                $user = User::create([
                    'company' => $request->company,
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

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'userlogin' => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->input('userlogin'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

        $request->merge([
            $login_type => $request->input('userlogin')
        ]);

        if (!auth()->attempt($request->only($login_type, 'password'))) {
            return back()->with('status', 'Invalid login details');
        }

        if(auth()->user()->is_activated == '1')
        {
            return redirect()->route('dashboard');
        }
        else 
        {
            return back()->with('status','Your Account was Disabled');
        }

            
    }
}

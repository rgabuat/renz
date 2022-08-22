<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB; 
use Carbon\Carbon; 
use App\Models\User;
use Mail; 
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    public function showChangePasswordGet() {
        return view('auth.change-password');
    }

    public function changePasswordPost(Request $request) {

    $this->validate($request, [
        'current-password' => 'required',
        'new-password' => 'required|string|min:8|confirmed',
    ]);

    if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
        // The passwords matches
        return redirect()->back()->with("status","Your current password does not matches with the password.");
    }
    if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        // Current password and new password same
        return redirect()->back()->with("status","New Password cannot be same as your current password.");
    }
    
    //Change Password
    $user = auth()->user();
    $user->password = Hash::make($request->get('new-password'));
    $user->save();
        return redirect()->back()->with("status","Password successfully changed!");
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $udata = [
            'email' => $request->email,
            'date' => Carbon::now()
        ];

        $token = base64_encode(json_encode($udata));
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('status', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) { 
        return view('auth.forgot-password-link', ['token' => $token]);
     }

     public function resetPassword(Request $request)
     {
            $decoded = base64_decode($request->udata);
            $json_data = json_decode($decoded,true);

            $request->validate([
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);

            $updatePassword = DB::table('password_resets')
                                ->where([
                                    'email' => $json_data['email'], 
                                    'token' => $request->udata
                                ])
                                ->first();
    
            if(!$updatePassword){
                return back()->withInput()->with('status', 'Invalid token!');
            }

    
            $user = User::where('email', $json_data['email'])->update(['password' => Hash::make($request->password)]);
            if($user)
            {
                DB::table('password_resets')->where(['email'=> $json_data['email']])->delete();
            }
    
            return redirect('/login')->with('status', 'Your password has been changed!');
    }
}

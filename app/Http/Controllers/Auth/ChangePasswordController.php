<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}

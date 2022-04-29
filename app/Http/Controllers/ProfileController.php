<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $roles = Role::all();
        return view('admin.profile.ViewProfile', compact('roles'));
    }

    public function edit()
    {

        $roles = Role::all();
        return view('admin.profile.EditProfile', compact('roles'));
    }



    public function update(Request $request,$uid)
    {
        // $this->validate($request, [
        //     'company' => 'required|max:255',
        //     'firstname' => 'required|max:255',
        //     'lastname' => 'required|max:255',
        //     'address' => 'required|max:255',
        //     'phone_number' => 'required|max:255',
        //     'username' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'password' => 'required',
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);
        
        if($request->has('image'))
        {
            $destinationPath = 'images/uploads';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('image')->storeAs($destinationPath,$file_name);
            
            $update_profile = User::where('id',$uid)->update(['profile_image' => $path]);
        }
        return redirect()->back()->with('status', 'Profile Successfully Update');
    }
    
}

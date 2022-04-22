<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.UsersList', compact('users'));
    }

    public function show()
    {

    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.UserAdd',compact('roles'));
    }
}

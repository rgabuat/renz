<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CompanyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // $users = User::all();
        return view('company.CompanyList');
    }

    public function show()
    {

    }

    public function create()
    {
        $roles = Role::all();
        return view('company.CompanyAdd',compact('roles'));
    }
}

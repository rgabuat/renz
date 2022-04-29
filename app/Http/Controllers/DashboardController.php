<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $data = Company::where('created_by_admin',auth()->user()->id)->with('admin_sub_accounts')->get();
        return view('dashboard.dashboard');
    }
}

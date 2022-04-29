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
        $data = Company::where('id',auth()->user()->id)->with('company')->get();

        foreach($data as $company)
        {
            echo json_encode($company);
        }

        return view('dashboard.dashboard');
    }
}

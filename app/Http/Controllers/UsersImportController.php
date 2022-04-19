<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show()
    {
        return view('admin.UserImport');
    }

    public function store(Request $request)
    {
       $file = $request->file('file');
       Excel::import(new UserImport,$file);

       return back()->with('status','Excel File Imported Successfully');
    }
}

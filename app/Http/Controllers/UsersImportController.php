<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Imports\UserCollection;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show()
    {
        return view('admin.UserImport');
    }


    public function parse(Request $request){
        $location=$request->file('file');
        $rpath = $location->getClientOriginalName();
        if($request->hasFile('file')){
            $data =  Excel::toArray(new UserCollection, $location);
            $heading = Excel::toArray([], $location);
            $result = array(
                'data'           =>$data,
                'page_header'    =>'Review Uploaded file',
                'location'       =>$location,  
          );

            $param = [
                'users' => $data[0],
                'heading' => $heading[0][0],
                'location' => $rpath
            ];
           
        }
        return view('admin.UserImportPreview', compact('param'));
    }

    public function store(Request $request)
    {
       $file = $request->file('file');
       Excel::import(new UserImport,$file);

       return back()->with('status','Excel File Imported Successfully');
    }
}

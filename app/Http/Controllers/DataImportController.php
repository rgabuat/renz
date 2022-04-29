<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Imports\DomainImport;
use App\Imports\UserCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DataImportController extends Controller
{
    public function show()
    {
        return view('admin.import.DataImport');
    }


    public function parse(Request $request){
        $location=$request->file('file');
        $rpath = $location->getClientOriginalName();
        if($request->hasFile('file')){
            $data =  Excel::toArray(new UserCollection, $location);
            $heading = Excel::toArray([], $location);

            $destinationPath = 'public/excels/uploads';
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('file')->storeAs($destinationPath,$file_name);
            // $destinationFQN = "$destinationPath/$destinationName";
          
            $param = [
                'users' => $data[0],
                'heading' => $heading[0][0],
                'location' => $file_name
            ];
           
        }
        return view('admin.import.DataImportPreview', compact('param'));
    }

    public function store(Request $request)
    {
        $filename = $request->file;
        $destinationPath = storage_path() .'/app/public/excels/uploads';
        $file = $destinationPath.'/'.$filename;
        
        Excel::import(new DomainImport,$file);

        Storage::delete('/storage/app/public/excels/uploads'.$filename);
        return redirect('./data/import')->with('status','Excel File Imported Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Imports\DomainImport;
use App\Imports\UserCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Models\Domain;
use Carbon\Carbon;

class DataImportController extends Controller
{

    public function index()
    {
        $domain_datas = Domain::all();
        return view('admin.import.DataList',compact('domain_datas'));
    }

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
        return redirect('./domain/import')->with('status','Excel File Imported Successfully');
    }


    public function create()
    {
        return view('domain.DomainAdd');
    }

    public function input(Request $request)
    {
        $this->validate($request,[
            'domain' => 'required|max:255',
            'country' => 'required|max:255',
            'traffic' => 'required|max:255',
            'token_cost' => 'required|max:255',
        ]);


        $domain = Domain::create([
            'domain' => $request->domain,
            'country' => $request->country,
            'domain_rating' => $request->domain_rating,
            'traffic' => $request->traffic,
            'ref_domain' => $request->ref_domain,
            'token_cost' => $request->token_cost,
            'remarks' => $request->remarks,
        ]);

        if($domain)
        {
            return redirect()->back()->with('status','Domain Creation Success!');
        }
    }

    public function edit($id)
    {
        $domain = Domain::find($id);
        return view('domain.DomainEdit',compact('domain'));
    }

    public function update(Request $request,$id)
    {
        $now = Carbon::now()->format('m/d/Y');
        $this->validate($request,[
            'domain' => 'required|max:255',
            'country' => 'required|max:255',
            'traffic' => 'required|max:255',
            'token_cost' => 'required|max:255',
        ]);
        $domain_update = [
            'domain' => $request->domain,
            'country' => $request->country,
            'domain_rating' => $request->domain_rating,
            'traffic' => $request->traffic,
            'ref_domain' => $request->ref_domain,
            'token_cost' => $request->token_cost,
            'remarks' => $request->remarks,
            'last_updated' => $now,
        ];
        $response = Domain::where('id',$id)->update($domain_update);
        if($response)
        {
            return redirect()->back()->with('status','Domain Update Success!');
        }
    }

    public function delete($id)
    {
        $destroy = Domain::where('id',$id)->delete();

        if($destroy)
        {
            return redirect()->back()->with('status','Domain Delete Success!');
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Package;
use App\Models\Subscriptions;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('user')->get();
        return view('packages.Lists',compact('packages'));
    }

    public function create()
    {
        return view('packages.Create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:255|unique:tbl_package,name',
            'price' => 'required|max:255',
            'credits' => 'required|max:255',
            'payment_method' => 'required|max:255',
            'duration' => 'required|max:255',

        ]);

        $package = Package::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'credits' => $request->credits,
            'payment_method' => $request->payment_method,
            'duration' => $request->duration,
            'created_by' => Auth()->user()->id,
        ]);

        if($package)
        {
            return redirect()->back()->with('status','New Package Created');
        }
        else 
        {
            return redirect()->back()->with('status','Something went wrong!');
        }

    }

    public function edit($pid)
    {
        $article = Article::where('id',$aid)->get();
        return view('articles.Edit',compact('article'));
    }

    public function update(Request $request,$pid)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:tbl_package,name,'.$pid,
            'price' => 'required|max:255',
            'credits' => 'required|max:255',
            'payment_method' => 'required|max:255',
            'duration' => 'required|max:255',
        ]);

        $package_update = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'credits' => $request->credits,
            'payment_method' => $request->payment_method,
            'duration' => $request->duration,
        ];

        $update = Package::where('id',$pid)->update($package_update);

        if($update)
        {
            return redirect()->back()->with('status','Package Updated');
        }
        else 
        {
            return redirect()->back()->with('status','Something went wrong!');
        }
   
    }

    public function delete($aid)
    {
        $destroy = Package::where('id',$aid)->delete();

        if($destroy)
        {
            return redirect()->back()->with('status','Package Delete Success!');
        }
    }

    public function buy($aid)
    {
        $buy = Package::where('id',$aid)->get();

        $subscription = Subscriptions::create([
            'user_id' => auth()->user()->id,
            'company_id' => auth()->user()->company_id,
            'started_at' => 'null',
            'expires_at' => 'null',
            'avail_credits' => $buy[0]['credits'],
            'package_id' =>  $buy[0]['id'],
        ]);
        
        if($subscription)
        {
            return redirect()->back()->with('status','Package request Sent');
        }
    }
}

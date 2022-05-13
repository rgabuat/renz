<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
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

        return redirect()->back()->with('status','New Package Created');
    }

    public function edit($pid)
    {
        $article = Article::where('id',$aid)->get();
        return view('articles.Edit',compact('article'));
    }

    public function update(Request $request,$aid)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:table_article,title',
            'url' => 'required|max:255|unique:table_article,url',
            'category' => 'required|max:255',
            'author' => 'required|max:255',
        ]);

        $article_data = [
            'title' => $request->title,
            'url' => $request->url,
            'body' => $request->body,
            'categories' => $request->category,
            'author' => $request->author,
        ];

        $article_update = Article::where('id',$aid)->update($article_data);
        return redirect()->back()->with('status','Article Update');
    }

    public function delete($aid)
    {
        $destroy = Article::where('id',$aid)->delete();

        if($destroy)
        {
            return redirect()->back()->with('status','Article Delete Success!');
        }
    }
}

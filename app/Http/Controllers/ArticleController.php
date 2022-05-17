<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $articles = Article::all();
        }
        else 
        {
            $uid = auth()->user()->company_id;
            $articles = Article::with('created_by_company')->whereHas('created_by_company', function ($query) use ($uid) { $query->where('company_id',$uid); })->get();
        }
        return view('articles.Lists',compact('articles'));
    }

    public function create()
    {
        return view('articles.Create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required|max:255|unique:table_article,title',
            'url' => 'required|max:255|unique:table_article,url',
            'category' => 'required|max:255',
            'author' => 'required|max:255',
        ]);

        $now = Carbon::now()->format('m/d/Y');

        if($request->has('featured_image'))
        {
            $destinationPath = 'excels/uploads';
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('featured_image')->storeAs($destinationPath,$file_name,'public');

            $featured_image = $path;
        }
        else 
        {
            $featured_image = '';
        }

        $company = Article::create([
            'title' => $request->title,
            'url' => $request->url,
            'body' => $request->body,
            'categories' => $request->category,
            'author' => $request->author,
            'featured_image' => $featured_image,
            'created_by' => auth()->user()->id,
            'publishing_date' => $now,
        ]);

        return redirect()->back()->with('status','New Article Created');
    }

    public function edit($aid)
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

        if($request->has('featured_image'))
        {
            $destinationPath = 'excels/uploads';
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('featured_image')->storeAs($destinationPath,$file_name,'public');
            $image = $path;

            $featured_image = [
                'featured_image' =>  $image
            ];

            $article_update = Article::where('id',$aid)->update($featured_image);
        }

        $article_data = [
            'title' => $request->title,
            'url' => $request->url,
            'body' => $request->body,
            'categories' => $request->category,
            'author' => $request->author,
        ];

        $article_update = Article::where('id',$aid)->update($article_data);
        if($article_update)
        {
            return redirect()->back()->with('status','Article Updated');
        }
       
    }

    public function delete($aid)
    {
        $destroy = Article::where('id',$aid)->delete();

        if($destroy)
        {
            return redirect()->back()->with('status','Article Delete Success!');
        }
    }

    public function upload_img(Request $request)
    {
        if($request->has('file'))
        {
            $destinationPath = 'excels/uploads';
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('file')->storeAs($destinationPath,$file_name,'public');
            return response()->json(['location' => "/storage/$path"]);
        }
    }
}

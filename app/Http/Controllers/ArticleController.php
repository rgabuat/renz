<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
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

        $company = Article::create([
            'title' => $request->title,
            'url' => $request->url,
            'body' => $request->body,
            'categories' => $request->category,
            'author' => $request->author,
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\ArticleOrder;
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
            'publish_date' => 'required',
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
            'publishing_date' => $request->publish_date,
            'status' => 'draft',
            'domain_id' => $request->did,
        ]);

        return redirect()->back()->with('status','New Article Created');
    }

    public function show($aid)
    {
        $article = Article::where('id',$aid)->get();
        return view('articles.View',compact('article'));
    }

    public function edit($aid)
    {
        $article = Article::where('id',$aid)->get();
        return view('articles.Edit',compact('article'));
    }

    public function update(Request $request,$aid)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:table_article,title,'.$aid,
            'url' => 'required|max:255|unique:table_article,url,'.$aid,
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

    public function order()
    {
        return view('articles.Order');
    }

    public function make_order(Request $request,$uid,$cid)
    {   
        $this->validate($request, [
            'offer' => 'required|max:255|unique:table_article,url',
            'heading' => 'required|max:255',
            'link_url_1' => 'required|max:255',
            'anchor_1' => 'required|max:255',
            'publish_date' => 'required|max:255',
        ]);

        $order = ArticleOrder::create([
            'offer' => $request->offer,
            'heading' => $request->heading,
            'link_url_1' => $request->link_url_1,
            'link_url_2' => $request->link_url_2,
            'anchor_1' => $request->anchor_1,
            'anchor_2' => $request->anchor_2,
            'user_id' => $uid,
            'company_id' => $cid,
            'accepted_at' => 'null',
            'completed_at' => 'null',
            'publishing_date' => $request->publish_date,
            'status' => 'pending',
            'domain_id' => $request->did,
        ]);

        if($order)
        {
            return redirect()->back()->with('status','Order Created');
        }
    }

    public function requests()
    {
        
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $requests = ArticleOrder::all();
        }
        else 
        {
            $requests = ArticleOrder::where('company_id',auth()->user()->company_id)->get();
        }
        return view('articles.Requests',compact('requests'));
    }

    public function orders()
    {
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $orders = ArticleOrder::all();
        }
        else 
        {
            $orders = ArticleOrder::where('status','!=','completed')->where('company_id',auth()->user()->company_id)->get();
        }

        return view('articles.Orders',compact('orders'));
    }

    public function order_approve($aid)
    {
        if($aid != '')
        {
            $params = [
                'accepted_at' => Carbon::now(),
                'status' => 'processing'
            ];

            $approve  = ArticleOrder::where('id',$aid)->update($params);

            if($approve)
            {
                return redirect()->back()->with('status','Order Accepted');
            }
        }
    }

    public function order_decline($aid)
    {
        if($aid != '')
        {
            
        }
    }

    public function order_publish(Request $request,$aid)
    {
        if($aid != '')
        {
            $this->validate($request, [
                'url' => 'required|max:255|unique:table_article,url,'.$aid,
            ]);
    
            $params = [
                'completed_at' => Carbon::now(),
                'status' => 'completed'
            ];

            $approve  = ArticleOrder::where('id',$aid)->update($params);

            if($approve)
            {
                return redirect()->back()->with('status','Article Published');
            }
        }
    }

    public function publish_request($aid)
    {
        if($aid != '')
        {
            $params = [
                'publishing_date' => Carbon::now(),
                'status' => 'published'
            ];

            $published  = Article::where('id',$aid)->update($params);

            if($published)
            {
                return redirect()->back()->with('status','Article Published');
            }
        }
    }

    public function completed_orders()
    {
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $completeorders = ArticleOrder::all();
        }
        else 
        {
            $completeorders = ArticleOrder::where('status','completed')->where('company_id',auth()->user()->company_id)->get();
        }
        return view('articles.Completed',compact('completeorders'));
    }

    public function delete_order($aid)
    {
        $destroy = ArticleOrder::where('id',$aid)->delete();

        if($destroy)
        {
            return redirect()->back()->with('status','Article Order Deleted!');
        }
    }

    public function show_order($aid)
    {
        
    }

    public function update_order($aid)
    {

    }
}

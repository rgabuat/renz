<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Carbon\Carbon;
use \Stripe\Stripe;
use \Stripe\Plan;

use App\Models\Article;
use App\Models\ArticleOrder;
use App\Models\Domain;
use App\Models\Company;


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

    public function create($did)
    {

        $params = Domain::where('id',$did)->get();
        return view('articles.Create',compact('params'));
    }

    public function store(Request $request)
    {

        $company = Company::find(auth()->user()->company_id);
        $now = Carbon::now()->format('m/d/Y');

        $this->validate($request, [
            'title' => 'required|max:255|unique:table_article,title',
            'url' => 'required|max:255',
            'publish_date' => 'required',
            'category' => 'required|max:255',
            'author' => 'required|max:255',
        ]);

        
        if($company->stripe_id == NULL)
        {
            return redirect()->back()->with('error','subscribe first to publish an article');
        }
        elseif($company->avail_credits == 0)
        {
            return redirect()->back()->with('error','Insufficient Token');
        }

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

        $articleStore = Article::create([
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
        if($articleStore)
        {
            return redirect()->back()->with('success','New Article Created');
        }
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

    public function order($did)
    {
        $params = Domain::where('id',$did)->get();
        return view('articles.Order',compact('params'));
    }

    public function make_order(Request $request,$uid,$cid)
    {   
        $this->validate($request, [
            'heading' => 'required|max:255|unique:table_article,url',
            'offer' => 'required|max:255',
            'link_url_1' => 'required|max:255',
            'anchor_1' => 'required|max:255',
            'publish_date' => 'required|max:255',
        ]);

        $company = Company::find(auth()->user()->company_id);
        if($company->stripe_id == NULL)
        {
            return redirect()->back()->with('error','subscribe first to publish an article');
        }
        elseif($company->avail_credits == 0)
        {
            return redirect()->back()->with('error','Insufficient Token');
        }

        $offer_price = 0;

        if($request->offer == 'standard')
        {
            $offer_price = 15;
        }
        else 
        {
            $offer_price = 30;
        }

        $ord_id = 'ORD_'.str_pad(Str::random(16), 8, "0", STR_PAD_LEFT);
        $order = ArticleOrder::create([
            'ord_id' => $ord_id,
            'price' => $offer_price,
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
            return redirect()->back()->with('success','Order Created');
        }
        else 
        {
            return redirect()->back()->with('error','Something happen');
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
            $orders = ArticleOrder::with('domains')->where('status','!=','completed')->where('company_id',auth()->user()->company_id)->get();
        }

        return view('articles.Orders',compact('orders'));
    }

    public function order_approve($aid)
    {
        if($aid != '')
        {
            $order = ArticleOrder::with('domains')->where('id',$aid)->first();
            $company = Company::where('id',$order->company_id)->first();
            $params = [
                'accepted_at' => Carbon::now(),
                'status' => 'processing'
            ];

            $approve  = ArticleOrder::where('id',$aid)->update($params);
            if($approve)
            {
                $company_curr_credit = $company->avail_credits;
                $tokenPrice = $order->domains[0]->token_cost;
                $balance = $company_curr_credit - $tokenPrice;

                $response = Company::where('id',$company->id)->update(['avail_credits' => $balance]);
                return redirect()->back()->with('success','Order Accepted');
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
            $article = Article::with('created_by_company','domain')->where('id',$aid)->first();
            $company = Company::find($article->created_by_company[0]->company_id);
            $params = [
                'publishing_date' => Carbon::now(),
                'status' => 'published'
            ];

            $resp  = Article::where('id',$aid)->update($params);

            if($resp)
            {
                $company_curr_credit = $company->avail_credits;
                $tokenPrice =  $article->domain->token_cost;
                $balance = $company_curr_credit - $tokenPrice;

                $response = Company::where('id',$company->id)->update(['avail_credits' => $balance]);
                if($response)
                {
                    return redirect()->back()->with('success','Article Published');
                }
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
        $viewSingleOrder = ArticleOrder::where('status','completed')->where('id',$aid)->get();
        return view('articles.ViewOrder',compact('viewSingleOrder'));
    }

    public function update_order($aid)
    {

    }

    public function transactions()
    {

        $stripe = new \Stripe\StripeClient(\config('services.stripe.secret'));

        $user = auth()->user();
        $user->createOrGetStripeCustomer();

        $invoices = ArticleOrder::where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->get();
        $invSum = $invoices->sum('price');

         $user = auth()->user();
        $invoicesLogs = $user->invoices();

        // dd($invoicesLogs);

        

        // $test = $stripe->invoices->create(
        //     [
        //       'customer' => 'cus_MLc092AGp14eLi',
        //       'collection_method' => 'send_invoice',
        //       'days_until_due' => 30,
        //       'custom_fields' => [
        //         ['name' => 'PO number', 'value' => '12345'],
        //         ['name' => 'VAT', 'value' => '123ABC'],
        //       ],
        //     ]
        //   );

    
        // if($invSum)
        // {
        //     $user->invoiceFor('One Time Fee', $invSum * 100);
        // }
    }
}

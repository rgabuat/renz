<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleOrder;
use App\Models\Domain;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $date = Carbon::now();
        $domainUsed = ArticleOrder::select('id','created_at')->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
       
        $domainUsedCount = [];
        $domainArray = [];

        foreach ($domainUsed as $key => $value) {
            $domainUsedCount[$key] = $value;
        }

        dd($domainUsedCount);

        
        $domains = Domain::all()->count();

        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $articleCreated = Article::all()->count();
        }
        else 
        {
            $uid = auth()->user()->company_id;
            $articleCreated = Article::with('created_by_company')->whereHas('created_by_company', function ($query) use ($uid) { $query->where('company_id',$uid); })->count();
        }

        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $articleOrdered = ArticleOrder::all()->count();
        }
        else
        {
            $articleOrdered = ArticleOrder::where('company_id',auth()->user()->company_id)->count();
        }


        $articledPublished = Article::where('status','published')->count();
        $articleOrderedPublished = ArticleOrder::where('status','completed')->count();

        return view('dashboard.dashboard',compact('domains','articleCreated','articleOrdered','articledPublished','articleOrderedPublished'));
    }
}

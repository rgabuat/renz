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
    
    public function index(Request $request)
    {
        
        //get months 
        $monthsDigit = [];
        $monthsName = [];

        for ($m=1; $m<=12; $m++) {
            $monthsDigit[] = date('m', mktime(0,0,0,$m, 1, date('Y')));
        }
        for ($m=1; $m<=12; $m++) {
            $monthsName[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        $arrayMonths = [
            'digits' => $monthsDigit,
            'name' => $monthsName,
        ];
        
        
        if($request->filter_date != '')
        {
                $month = $request->filter_date;
        }
        else 
        {
                $extractMonth = Carbon::now();
                $month = $extractMonth;
        }
            
        // domains
        $domainUsedOrdered = ArticleOrder::select('domain_id')->distinct()->whereMonth('created_at',$month)->get()->count();
        $domainUsedCreated = Article::select('domain_id')->distinct()->whereMonth('created_at',$month)->get()->count();
        $domainUsedSum = $domainUsedOrdered + $domainUsedCreated;


        $domainTotal = Domain::whereMonth('created_at',$month)->get()->count();
        $domainsAdded = Domain::distinct()->whereMonth('created_at',$month)->get()->count();

        //articles created
        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $articleCreated = Article::whereMonth('created_at',$month)->get()->count();
            $articlePublished = Article::all()->whereMonth('created_at',$month)->where('status','published')->count();
            $articlePending = Article::all()->whereMonth('created_at',$month)->where('status','draft')->count();
        }
        else 
        {
            $uid = auth()->user()->company_id;
            $articleCreated = Article::with('created_by_company')->whereHas('created_by_company', function ($query) use ($uid) { $query->where('company_id',$uid); })->whereMonth('created_at',$month)->get()->count();
            $articlePublished = Article::with('created_by_company')->whereHas('created_by_company', function ($query) use ($uid) { $query->where('status','published'); })->whereMonth('created_at',$month)->get()->count();
            $articlePending = Article::with('created_by_company')->whereHas('created_by_company', function ($query) use ($uid) { $query->where('status','draft'); })->whereMonth('created_at',$month)->get()->count();
       
        }

        if(auth()->user()->hasRole(['system admin','system editor','system user']))
        {
            $articleOrdered = ArticleOrder::all()->whereMonth('created_at',$month)->get()->count();
            $articleOrderedPending = ArticleOrder::where('status','pending')->whereMonth('created_at',$month)->get()->count();
            $articleOrderedCompleted = ArticleOrder::where('status','completed')->whereMonth('created_at',$month)->get()->count();
            $articleOrderedProcessing = ArticleOrder::where('status','processing')->whereMonth('created_at',$month)->get()->count();
        }
        else
        {
            $articleOrdered = ArticleOrder::where('company_id',auth()->user()->company_id)->whereMonth('created_at',$month)->get()->count();
            $articleOrderedPending = ArticleOrder::where('company_id',auth()->user()->company_id)->where('status','pending')->whereMonth('created_at',$month)->get()->count();
            $articleOrderedCompleted = ArticleOrder::where('company_id',auth()->user()->company_id)->where('status','completed')->whereMonth('created_at',$month)->get()->count();
            $articleOrderedProcessing = ArticleOrder::where('company_id',auth()->user()->company_id)->where('status','processing')->whereMonth('created_at',$month)->get()->count();
        }


        $articledPublished = Article::where('status','published')->count();
        $articleOrderedPublished = ArticleOrder::where('status','completed')->count();

        return view('dashboard.dashboard',compact('domainTotal','domainsAdded','domainUsedSum','articleCreated','articlePublished','articlePending','articleOrdered','articleOrderedPending','articleOrderedCompleted','articleOrderedProcessing','arrayMonths'));
    }
}


// SELECT DATE_FORMAT(date,'%Y-%m') AS date_period, COUNT(*) AS c 
// FROM (SELECT DISTINCT date,user_id FROM stats) t
// GROUP BY DATE_FORMAT(date,'%Y-%m')
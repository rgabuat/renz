<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    
    
    public function priser_page()
    {
        return view('landing/index');
    }

    public function contact_page()
    {
        return view('landing/contact');
    }
    
    public function services_page()
    {
        return view('landing/services');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

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

    public function send_contact_us(Request $request)
    {


        $data = [
            'name' => $request->name,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
            'message_body' => $request->message,
        ];

    
        try{
            Mail::send('email.contactUs',$data,function($message){
                $message->to('johncarlgabuat@gmail.com');
                $message->subject('Contact Us');
                $message->from('johncarlgabuat@gmail.com','Link Building System');
            });
            return redirect()->back()->with('success','Email Successlly sent!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error','Failed Delivery message.');
        }    
    }
    
    public function services_page()
    {
        return view('landing/services');
    }

}

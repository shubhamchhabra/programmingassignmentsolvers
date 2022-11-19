<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController
{
   public function index(){
       return view('contact.contact');
   }

   public function store(Request $request){

       $validated = $request->validate([
          'name' => 'required',
          'email' => 'required',
          'subject' => 'required',
          'message' => 'required',
           'g-recaptcha-response' => ['required', new Recaptcha()]
       ]);

           $contactDetails = [
               'name' => $request->name,
               'email' => $request->email,
               'subject' => $request->subject,
               'message' => $request->message
           ];

           Mail::to('ankit4gaurav@gmail.com')->send(new \App\Mail\Contact($contactDetails));

           if(Mail::failures()){
               return back()->with('error', 'Something went wrong, please try again later!');
           }else{
               return back()->with('success', 'Thank you, we will connect with you soon!');
           }
   }
}

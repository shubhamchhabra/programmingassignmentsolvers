<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;

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

       try {
           $contact = new Contact();
           $contact->name = $request->name;
           $contact->email = $request->email;
           $contact->subject = $request->subject;
           $contact->message = $request->message;

           if($contact->save()){
               return back()->with('success', 'Thank you, we will connect with you soon!');
           }
       }catch (\Exception $e){
           return back()->with('error', 'Something went wrong, please try again later!');
       }
   }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends SendEmailController
{
    public function index(){
        $timeZones = file_get_contents('http://api.timezonedb.com/v2.1/list-time-zone?key=AAJACVIND1RF&format=json');
        $timeZones = json_decode($timeZones, true);
        if($timeZones['status']){
            $timeZones = $timeZones['zones'];
        }
        return view('order.order', ['timeZones' => $timeZones ]);
    }

    public function store(Request $request){
        //Add Validation here
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'deadline' => 'required',
            'no_pages' => 'required',
            'assignment_file' => 'mimes:pdf,png,jpg,jpeg'
        ],
            ['no_pages.required' => 'Number of pages is required']
        );

        $order = new  Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->user_id = Auth::user()->id;
        $order->status = ORDER::ORDER_SUBMITTED;
        $order->subject = $request->subject;
        $order->subject_title = $request->subject_title;
        $order->deadline = $request->deadline;
        $order->timezone = $request->timezone;
        $order->ref_code = $request->ref_code;
        $order->requirement = $request->requirement;
        $order->academic = $request->academic;
        $order->no_pages = $request->no_pages;
        $order->description = $request->description;

        //Upload files
       if($request->has('assignment_file')){
           $file = $request->file('assignment_file');
           $fileName = $file->getClientOriginalName();
           $file->move(public_path('upload'), $fileName);
           $order->assignment_file = $fileName;
       }

       if($order->save()){
           $emailResponse = $this->sendEmailToAdmin($order->id);
           if($emailResponse['status']){
               return back()->with('success', 'Thank you for ordering, we will connect with you on email!');
           }
       }else{
           return back()->with('error', 'Sorry, Something went wrong!');

       }


    }
}

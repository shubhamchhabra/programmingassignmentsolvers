<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'assignment_file' => 'mimes:pdf,png,jpg,jpeg'
        ],
            ['no_pages.required' => 'Number of pages is required', 'number.required' => 'Contact number is required', 'number.numeric' => 'Contact number must be number', 'number.size' => 'Contact number must be 10 digits'],
        );

        $userExist = User::where('email',$request->email)->get();
        $userId ='';
        if(!Auth::check() && $userExist->count() === 0){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->email),
                'type' => 'user',
            ]);
            $userId = $user['id'];
        }
        $order = new  Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->user_id = Auth::check() ? Auth::user()->id : $userId;
        $order->status = ORDER::ORDER_SUBMITTED;
        $order->subject = $request->subject;
        $order->subject_title = $request->subject_title;
        $order->deadline = $request->deadline;
        $order->timezone = $request->timezone;
        $order->ref_code = $request->ref_code;
        $order->requirement = $request->requirement;
        $order->academic = $request->academic;
        $order->number = $request->number;
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

<?php

namespace App\Http\Controllers;

use App\Mail\UserOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function sendEmailToAdmin($id){
        $order = Order::find($id);

        Mail::to('shubhamchhabra222@gmail.com')->send(new UserOrder($order));

        if (Mail::failures()) {
            return ['status' => false, 'message' => 'Sorry! Please try again latter'];
        }else{
            return ['status' => true, 'message' => 'Great! Successfully send in your mail'];
        }
    }
}

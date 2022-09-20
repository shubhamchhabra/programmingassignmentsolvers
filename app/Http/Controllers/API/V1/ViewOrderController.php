<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ViewOrderController extends BaseController
{
    public function index(){
        $orders = Order::latest()->with('user')->paginate(10);
        return $this->sendResponse($orders, 'orders');

    }
    public function view(){
        $id = $_GET['id'];
        $order = Order::with('user')->find($id);
        return json_encode($order);
    }
    public function update(Request $request, $id){
        //Add Validation here

        $order = Order::find($id);
        $order->status = $request->status;
        if($order->save()){
            $response = ['status' => true, 'message' => 'Order Status Updated'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }
}

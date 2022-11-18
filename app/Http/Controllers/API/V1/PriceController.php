<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends BaseController
{
   public function index(){
       $prices = Price::latest()->paginate(10);

       return $this->sendResponse($prices, 'Prices');
   }

   public function store(Request $request){
       //Add Validation here
       $validated = $request->validate([
           'title' => 'required',
           'price' => 'required|numeric',
           'description' => 'required'
       ],
       );
       $price = new Price();
       $price->title = $request->title;
       $price->price = $request->price;
       $price->description = $request->description;

       if($price->save()){
           $response = ['status' => true, 'message' => 'Price Created'];
       }else{
           $response = ['status' => false, 'message' => 'Something went wrong'];
       }
       return json_encode($response);
   }

   public function update(Request $request, $id){
       //Add Validation here
       $validated = $request->validate([
           'title' => 'required',
           'price' => 'required|numeric',
           'description' => 'required'
       ],
       );

       $price = Price::find($id);
       $price->title = $request->title;
       $price->price = $request->price;
       $price->description = $request->description;

       if($price->save()){
           $response = ['status' => true, 'message' => 'Price Updated'];
       }else{
           $response = ['status' => false, 'message' => 'Something went wrong'];
       }
       return json_encode($response);
   }

   public function destroy($id){
       $price = Price::find($id);
       if($price->delete()){
           $response = ['status' => true, 'message' => 'Price Deleted'];
       }else{
           $response = ['status' => false, 'message' => 'Something went wrong'];
       }
       return json_encode($response);
   }
}

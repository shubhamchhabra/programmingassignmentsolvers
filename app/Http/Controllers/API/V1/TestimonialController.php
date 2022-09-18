<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends BaseController
{

    public function index(){
      //Get the all testimonials
       $testimonial = Testimonial::latest()->with('user')->paginate(10);

        return $this->sendResponse($testimonial, 'Testimonial');
    }

    public function store(Request $request){

        //Add Validation here
        $validated = $request->validate([
            'message' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
        ],
            ['user_id.required' => 'User name is required']
        );
        $testimonial = new Testimonial();
        $testimonial->user_id = $request->user_id;
        $testimonial->message = $request->message;
        $testimonial->rating = $request->rating;

        if($testimonial->save()){
            $response = ['status' => true, 'message' => 'Testimonial Created'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function update(Request $request, $id){
        //Add Validation here
        $validated = $request->validate([
            'message' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
        ],
            ['user_id.required' => 'User name is required']

        );

        $testimonial = Testimonial::find($id);
        $testimonial->user_id = $request->user_id;
        $testimonial->message = $request->message;
        $testimonial->rating = $request->rating;

        if($testimonial->save()){
            $response = ['status' => true, 'message' => 'Testimonial Updated'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function destroy($id){

        $testimonial = Testimonial::find($id);
        if($testimonial->delete()){
            $response = ['status' => true, 'message' => 'Testimonial Deleted'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);

    }
}

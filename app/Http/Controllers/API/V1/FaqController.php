<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    public function index(){
        //Get the all testimonials
        $faqs = Faq::latest()->paginate(10);

        return $this->sendResponse($faqs, 'Faq');
    }

    public function store(Request $request){

        //Add Validation here
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ],
//            ['user_id.required' => 'User name is required']
        );
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;


        if($faq->save()){
            $response = ['status' => true, 'message' => 'FAQ Created'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function update(Request $request, $id){
        //Add Validation here
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ],
//            ['user_id.required' => 'User name is required']

        );
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;

        if($faq->save()){
            $response = ['status' => true, 'message' => 'FAQ Updated'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function destroy($id){

        $faq = Faq::find($id);
        if($faq->delete()){
            $response = ['status' => true, 'message' => 'FAQ Deleted'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);

    }



}

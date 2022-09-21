<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\StaticPages;
use Illuminate\Http\Request;

class StaticPagesController extends BaseController
{
    public function index(){
        //Get all static pages
        $pages = StaticPages::latest()->paginate(10);

        return $this->sendResponse($pages, 'Static Pages');
    }

    public function store(Request $request){

        //Add Validation here
        $validated = $request->validate([
            'title' => 'required',
            'urlTitle' => 'required',
            'description' => 'required'
        ],
            ['urlTitle.required' => 'The url of page is required']
        );
        $pages = new StaticPages();
        $pages->title = $request->title;
        $pages->urlTitle = $request->urlTitle;
        $pages->description = $request->description;


        if($pages->save()){
            $response = ['status' => true, 'message' => 'Static Page is Created'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function update(Request $request, $id){
        $page = StaticPages::find($id);

        $validated = $request->validate([
            'title' => 'required',
            'urlTitle' => 'required',
            'description' => 'required'
        ],
            ['urlTitle.required' => 'The url of page is required']
        );
        $page->title = $request->title;
        $page->urlTitle = $request->urlTitle;
        $page->description = $request->description;

        if($page->save()){
            $response = ['status' => true, 'message' => 'Page Updated'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);


    }

    public function destroy($id){
        $page = StaticPages::find($id);

        if($page->delete()){
            $response = ['status' => true, 'message' => 'Page Deleted'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

}

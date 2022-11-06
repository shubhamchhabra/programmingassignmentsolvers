<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ServiceController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        //Get the all services
        $services = Service::latest()->paginate(10);
        
        return $this->sendResponse($services, 'services');
    }
    public function store(Request $request){
        //Add Validation here
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required | unique:services',
            'image_path' => 'required|mimes:jpg,jpeg,png',
        ],
            ['image_path.required' => 'The image is required', 'image_path.mimes' => 'The image is must be png, jpg or jpeg']
        );

        $service = new Service();
        $service->title = $request->title;
        $service->slug = strtolower($request->slug);
        $service->description = $request->description;

        //Upload files
        if($request->has('image_path')){
            $file = $request->file('image_path');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('service'), $fileName);
            $service->image_path = $fileName;
        }

        if($service->save()){
            $response = ['status' => true, 'message' => 'Service Created'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function edit(){
        $id = $_GET['id'];
        $service = Service::find($id);
        print_r($service);die;
        return json_encode($service);
    }

    public function update(Request $request, $id){

        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ],
        );

        if($request->hasFile('image_path')){
           $request->validate([
               'image_path' => 'mimes:jpg,png,jpeg'
           ],
           ['image_path.required' => 'The image must be png, jpg or jpeg']

           );
        }
        $service = Service::find($id);

        $service->title = $request->title;
        $service->slug = strtolower($request->slug);
        $service->description = $request->description;

        //Upload files
        if($request->hasFile('image_path')){
            $file = $request->file('image_path');
            if($service->image_path !== $request->image_path){
                $fileName = time().'.'.$file->getClientOriginalExtension();
                if($file->move(public_path('service'), $fileName)){
                    //Remove the old image from public folder
                    unlink(public_path('service/'.$service->image_path));
                    $service->image_path = $fileName;
                }

            }
        }

        if($service->save()){
            $response = ['status' => true, 'message' => 'Blog Post Updated'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);

    }

    public function destroy($id){

        $service = Service::find($id);
        $image = $service->image_path;

        //Check the image is present or not in folder
        $checkImage = File::exists(public_path('service/'.$image));

        if($service->delete()){
            if($checkImage){
                unlink(public_path('service/'.$image));
            }
            $response = ['status' => true, 'message' => 'Service Deleted'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        //Get the all testimonials
        $posts = Post::latest()->with('user')->paginate(10);

        return $this->sendResponse($posts, 'posts');
    }
    public function store(Request $request){
        //Add Validation here
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required | unique:posts',
            'image_path' => 'required|mimes:jpg,jpeg,png',
        ],
            ['image_path.required' => 'The image is required', 'image_path.mimes' => 'The image is must be png, jpg or jpeg']
        );

        $post = new Post();
        $post->title = $request->title;
        $post->slug = strtolower($request->slug);
        $post->description = $request->description;
        $post->user_id = Auth::id();

        //Upload files
        if($request->has('image_path')){
            $file = $request->file('image_path');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('post'), $fileName);
            $post->image_path = $fileName;
        }

        if($post->save()){
            $response = ['status' => true, 'message' => 'Blog Post Created'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

    public function edit(){
        $id = $_GET['id'];
        $post = Post::with('user')->find($id);
        return json_encode($post);
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
        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = strtolower($request->slug);
        $post->description = $request->description;
        $post->user_id = Auth::id();

        //Upload files
        if($request->hasFile('image_path')){
            $file = $request->file('image_path');
            if($post->image_path !== $request->image_path){
                $fileName = time().'.'.$file->getClientOriginalExtension();
                if($file->move(public_path('post'), $fileName)){
                    //Remove the old image from public folder
                    unlink(public_path('post/'.$post->image_path));
                    $post->image_path = $fileName;
                }

            }
        }

        if($post->save()){
            $response = ['status' => true, 'message' => 'Blog Post Updated'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);

    }

    public function destroy($id){

        $post = Post::find($id);
        $image = $post->image_path;

        //Check the image is present or not in folder
        $checkImage = File::exists(public_path('post/'.$image));

        if($post->delete()){
            if($checkImage){
                unlink(public_path('post/'.$image));
            }
            $response = ['status' => true, 'message' => 'FAQ Deleted'];
        }else{
            $response = ['status' => false, 'message' => 'Something went wrong'];
        }
        return json_encode($response);
    }

}

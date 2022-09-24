<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function view($slug){
        $post = Post::with('user')->where(['slug' => $slug])->first();

       return view('blog.show',['post' => $post]);
    }
}

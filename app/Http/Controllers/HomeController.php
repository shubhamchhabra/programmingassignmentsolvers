<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $testimonials = \App\Models\Testimonial::with('user')->get();
        $faqs = \App\Models\Faq::all()->take(3);
        $subjects = Category::all();
        return view('welcome',['testimonials' => $testimonials, 'faqs' => $faqs, 'subjects'=> $subjects]);
    }
}

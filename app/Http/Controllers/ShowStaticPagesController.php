<?php

namespace App\Http\Controllers;

use App\Models\StaticPages;
use Illuminate\Http\Request;

class ShowStaticPagesController extends Controller
{
    //Show the static pages on front-end
    public function show($url){

        $page = StaticPages::where('urlTitle', $url)->first();
        return view('static-pages.static-page',['page'=> $page]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function view($slug){
        $service = Service::where(['slug' => $slug])->first();
        print_r("Fsdfsd");die;
       return view('service.show',['service' => $service]);
    }
}

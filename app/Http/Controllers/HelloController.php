<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    public function index(Request $request){
        $data = ['msg'=>$request];
        //$data = $request;
        return view('hello', $data);
    }
}

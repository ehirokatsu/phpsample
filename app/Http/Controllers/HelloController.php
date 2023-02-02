<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    public function index(Request $request,$id, $tmp){

        $data = ['msg'=>$request,
        'id'=>$id,
        'tmp'=>$tmp,
    ];
        //$data = $request;
        return view('hello', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
    //
    public function index(Request $request,Response $response,$id=0, $tmp=1)
    {
        $data = [
            'req'=>$request,
            'res'=>$response,
            //'id'=>$id,
            //'tmp'=>$tmp,
            'id'=>$request->id,
            'tmp'=>$request->tmp,
            //'txt_empty'=>'',
        ];
        //$data = $request;
        return view('hello', $data);
    }

    public function create()
    {
        return view('welcome');
    }

    public function post(Request $request,Response $response)
    {
        $txt = $request->txt;
        $data = [
            'req'=>$request,
            'res'=>$response,
            //'id'=>$id,
            //'tmp'=>$tmp,
            'id'=>$request->id,
            'tmp'=>$request->tmp,
            'txt_empty'=>$request->txt_empty,
            'txt_isset'=>$request->txt_isset,
        ];
        return view('hello', $data);
    }
}

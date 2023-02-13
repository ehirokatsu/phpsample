<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

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

    public function validator(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'mail' => 'email',
        'age' => 'numeric|between:0,150',
    ]);
    if ($validator->fails()) {
        return redirect('/validator')
                    ->withErrors($validator)
                    ->withInput();
    }
    return view('validator', ['msg'=>'正しく入力されました！']);
    }
}

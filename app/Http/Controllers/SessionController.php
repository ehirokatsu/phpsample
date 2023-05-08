<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function get (Request $request) {

        //セッションから値を取得
        $sesdata = $request->session()->get('msg');
        return view('session', ['session_data' => $sesdata]);
    }

    public function put (Request $request) {

        //セッションに値を保存
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('session');
    }

}

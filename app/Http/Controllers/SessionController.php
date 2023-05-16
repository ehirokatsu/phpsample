<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function get (Request $request) {

       //$request->session()->forget('cart');
        //セッションから値を取得
        $cart = $request->session()->get('cart');
/*
        if (empty($cart)) {
            $cart = [
            [
            'id' => '',
            'num' => '',
            ]
        ];
        }
        */
        //dd( $array);


        return view('session', ['session_data' => $cart]);
        //return view('session');
    }

    public function put (Request $request) {

        //セッションに値を保存
        $item = $request->input;
        $item_num = $request->input_num;

        //現在のカート内容を取得
        $cart = $request->session()->get('cart');

        //追加された商品を取得
        $array = [
            'id' => $item,
            'num' => $item_num,
        ];  
        
        //カートに追加する
        if (!empty($cart)) {

            array_push($cart, $array);

        } else {

            $cart = [
                [
                    'id' => $item,
                    'num' => $item_num,
                ]
            ];  

        }

        //カートをsessionに保存する
        $request->session()->put('cart', $cart);

        return redirect('session');
    }


    public function destroy (Request $request, $id) {


        //現在のカート内容を取得
        $cart = $request->session()->get('cart');


        $index = $this->searchValue($cart, $id);
//dd($index);

        

        //isset(false)だとtrueになって先頭要素が削除されてしまう。
        //index != falseだと、index=0の時はfalseとなって削除されない
        if (isset($cart[$index]) || $index !== false) {
            unset($cart[$index]);
        }
        $cart = array_values($cart);
        //dd($cart);

        //カートをsessionに保存する
        $request->session()->put('cart', $cart);


        return redirect('session');
        
    }

    public function searchValue($array, $value) {
        foreach ($array as $index => $subArray) {
            $subIndex = array_search($value, $subArray);
            if ($subIndex !== false) {
                return $index;
            }
        }
        return false;
    }

}

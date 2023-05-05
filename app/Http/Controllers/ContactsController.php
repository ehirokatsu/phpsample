<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactsSendmail;

class ContactsController extends Controller
{
    //お問い合わせフォームトップページ
    public function index () {

        return view('contact.index');
    }

    //問い合わせフォームの入力値を受け取って確認画面を表示する
    public function confirm (Request $request) {

        //フォームのバリデーション
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'body' => 'required',
        ]);

        //フォームの入力値を確認用ビューに渡す
        $inputs = $request->all();
        return view('contact.confirm', [ 'inputs' => $inputs ]);
    }

    public function send (Request $request) {

        //hiddenで送信された内容をバリデーション（異常系）
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'body' => 'required',
        ]);

        //フォームのname="action"の値を取得
        $action = $request->input('action');

        //フォームのaction以外の値を取得
        /*以下の配列を取得できる。
        array(4) {
             ["_token"]=> string(40) "zTXAuvVjQ67RH8KNdnx6a39Y88NCmjmrIT42KxgO"
            ["email"]=> string(3) "test@test.com" 
            ["title"]=> string(1) "test-title" 
            ["body"]=> string(1) "test-body" 
        }
        */
        $inputs = $request->except('action');

        
        if ( $action !== 'submit') {

            //前画面に戻る処理
            return redirect()
            ->route('contact.index')
            ->without($inputs);

        } else {

            //入力されたメールアドレスに確認メールを送進する
            \Mail::to($inputs['email'])->send(new ContactsSendmail($inputs));

            //二重送進対策でトークン再発行
            $request->session()->regenerateToken();

            //送進完了のビューを表示
            return view('contact.thanks');
        }

    }
}

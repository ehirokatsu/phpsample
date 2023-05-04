<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailSendController extends Controller
{
    //
    public function index () {

        $data = [];

        //第1引数：メール本文になるビューファイル
        //第2引数：ビューに渡す変数
        //第3引数：メッセージインスタンスを受け取るクロージャ
        Mail::send('text', $data, function ($message) {
            $message->to('abc@example.com')
            ->from('src@example.com')
            ->subject('This is a test mail');
        });

        /*
        //以下だとビューファイルをテキスト文として送信する
        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('abc@example.com')
            ->from('src@example.com')
            ->subject('This is a test mail');
        });
        */
    }
}

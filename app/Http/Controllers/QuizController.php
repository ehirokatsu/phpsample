<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    //問題
    public function question()
    {
        $quiz = [
            'A' => "AA",
            'B' => "BB",
        ];
        return view('question', $quiz);
    }

    public function answer(Request $request)
    {
        
        $answer = $request->radioGroup;
        if ( $answer === "AA" ) {
            $result = "正解です";
        } else{
            $result = "不正解です";
        }
        
        return view('answer', ['result' => $result]);
    }
}

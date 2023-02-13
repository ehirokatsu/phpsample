<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HelloMiddleware;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('hello', function () {
    return view('hello');
});
*/


//ルートパラメータを使用する場合。**?はパラメータ省略化の
//Route::get('/{id?}/{tmp?}', 'App\Http\Controllers\HelloController@index');

//クエリ文字列を使用する場合
Route::get('/', 'App\Http\Controllers\HelloController@index');

Route::get('/create', 'App\Http\Controllers\HelloController@create');

Route::post('/', 'App\Http\Controllers\HelloController@post');

Route::get('section', function () {
    return view('section', ['message'=>'Hello!']);
});

Route::get('include-each', function () {
    $data = [
        ['name'=>'山田たろう', 'mail'=>'taro@yamada'],
        ['name'=>'田中はなこ', 'mail'=>'hanako@flower'],
        ['name'=>'鈴木さちこ', 'mail'=>'sachico@happy']
    ];
    return view('include-each', ['data'=>$data]);
});


Route::get('helloMiddle', function (Request $request) {
    return view('helloMiddle', ['data'=>$request->data]);
})->middleware(HelloMiddleware::class);

Route::get('/validator', function () {
    return view('validator', ['msg'=>'フォームを入力：']);
});
Route::post('/validator', 'App\Http\Controllers\HelloController@validator');

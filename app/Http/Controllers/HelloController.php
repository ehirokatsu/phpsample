<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\DB;

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
/*
    public function create()
    {
        return view('welcome');
    }
*/
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

    //テーブル表示
    public function dbclass(Request $request)
    {
        //DBクラス
        //$items = DB::select('select * from people');
        
        //クエリビルダ
        $items = DB::table('people')->get();

        return view('dbclass', ['items' => $items]);
    }

    //insert用ビュー
    public function add(Request $request)
    {
        return view('/add');
    }
 
    //insert実行
    public function create(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];

        //DBクラス
        //DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);

        //クエリビルダ
        DB::table('people')->insert($param);


        return redirect('/dbclass');
    }

    //update用ビュー
    public function edit(Request $request)
    {
       $param = ['id' => $request->id];

        //DBクラス
        //$item = DB::select('select * from people where id = :id', $param);
        //return view('edit', ['form' => $item[0]]);
        
        //クエリビルダ
        $item = DB::table('people')
        ->where('id', $request->id)
        ->first();
        return view('edit', ['form' => $item]);
    }
    
    //update実行
    public function update(Request $request)
    {
       $param = [
           'id' => $request->id,
           'name' => $request->name,
           'mail' => $request->mail,
           'age' => $request->age,
       ];

       //DBクラス
       //DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);

       //クエリビルダ
       DB::table('people')
       ->where('id', $request->id)
       ->update($param);
       return redirect('/dbclass');
    }

    //削除用ビュー
    public function del(Request $request)
    {
        $param = ['id' => $request->id];

        //DBクラス
        //$item = DB::select('select * from people where id = :id', $param);
        //return view('del', ['form' => $item[0]]);
       
        //クエリビルダ
        $item = DB::table('people')
        ->where('id', $request->id)->first();

        return view('del', ['form' => $item]);
    }

    //削除実行
    public function remove(Request $request)
    {
        $param = ['id' => $request->id];

        //DBクラス
        //DB::delete('delete from people where id = :id', $param);
 
        //クエリビルダ
        DB::table('people')
        ->where('id', $request->id)->delete();

        return redirect('/dbclass');
    }

}

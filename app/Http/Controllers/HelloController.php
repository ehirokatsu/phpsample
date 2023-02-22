<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Http\Myclass\Util;
use App\Http\Services\HelloService;

class HelloController extends Controller
{
    protected $helloService;

    public function __construct(HelloService $helloService)//use必須
    {
        $this->helloService = $helloService;
    }


    //
    public function index(Request $request,Response $response,$id=0, $tmp=1)
    {

        $util = new Util();
        //$tmp = Util::test();
        $tmp = $util->test();

        //newでインスタンス生成。bind内は呼ばれない
        //$helloService = new HelloService();
        //var_dump($helloService->echo());

        //app系でインスタンス生成。bind内は呼ばれる。以下は同義
        //$helloService = app()->make(\App\Http\Services\HelloService::class);//useなし
        //$helloService = app()->make('App\Http\Services\HelloService');//useなし
        //$helloService = app(\App\Http\Services\HelloService::class);//useなし
        //$helloService = app()->make(HelloService::class);//use必須
        //$helloService = app(HelloService::class);//use必須

        //bindをラベル指定。registerでもラベル指定にする
        //$helloService = app()->make('HelloService');
        //$helloService = app('HelloService');


        //var_dump($helloService->echo());
        //var_dump($helloService->foo);

        //コンストラクタインジェクション時に使用
        var_dump($this->helloService->echo());
        var_dump($this->helloService->foo);
        //var_dump($this->helloService->echo2());
        exit(1);

        $data = [
            'req'=>$request,
            'res'=>$response,
            //'id'=>$id,
            //'tmp'=>$tmp,
            'id'=>$request->id*$tmp,
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
    public function index_db(Request $request)
    {
        //DBクラス
        //$items = DB::select('select * from people');
        
        //クエリビルダ
        //$items = DB::table('people')->get();

        //Eloquent
        $items = Person::all();

        //共通
        return view('index_db', ['items' => $items]);
    }

    //insert用ビュー
    public function add(Request $request)
    {
        return view('/add');
    }
 
    //insert実行
    public function create(Request $request)
    {
        //DBクラス、クエリビルダで使用
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];

        //DBクラス
        //DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);

        //クエリビルダ
        //DB::table('people')->insert($param);

        //Eloquent
        $person = new Person();
        $person->name = $request->name;
        $person->mail = $request->mail;
        $person->age = $request->age;
        $person->save();

        //共通
        return redirect('/index_db');
    }

    //update用ビュー
    public function edit(Request $request)
    {
       

        //DBクラス
        /*
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('edit', ['form' => $item[0]]);
        */

        //クエリビルダ
        /*
        $item = DB::table('people')
        ->where('id', $request->id)
        ->first();
        return view('edit', ['form' => $item]);
        */

        //Eloquent
        $person = Person::find($request->id);
        return view('edit', ['form' => $person]);
    }
    
    //update実行
    public function update(Request $request)
    {
        //DBクラス、クエリビルダで使用
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

        //Eloquent
        $person = Person::find($request->id);
        $person->name = $request->name;
        $person->mail = $request->mail;
        $person->age = $request->age;
        $person->save();

        //共通
        return redirect('/index_db');
    }

    //削除用ビュー
    public function del(Request $request)
    {
        //DBクラス
        /*
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('del', ['form' => $item[0]]);
        */

        //クエリビルダ
        /*
        $item = DB::table('people')
        ->where('id', $request->id)->first();
        return view('del', ['form' => $item]);
        */

        //Eloquent
        $person = Person::find($request->id);
        return view('del', ['form' => $person]);

        
    }

    //削除実行
    public function remove(Request $request)
    {
    
        //DBクラス
        /*
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        */

        //クエリビルダ
        /*
        DB::table('people')
        ->where('id', $request->id)->delete();
        */

        //Eloquent
        Person::find($request->id)->delete();

        //共通
        return redirect('/index_db');
    }

    //検索用ビュー
    public function find(Request $request)
    {
        return view('find',['input' => '']);
    }

    //検索実行
    public function search(Request $request)
    {
        //DBクラス
        $param = ['input' => $request->input];
        $items = DB::select('select * from people where id = :input', $param);
        //$items[0]としないと配列で渡されてしまう
        $param = ['input' => $request->input, 'item' => $items[0]];

        //クエリビルダ
        $item = DB::table('people')->where('id', $request->input)->first();
        //var_dump($item);
        //exit();

        //Eloquent
        //$item = Person::find($request->input);


        $param = ['input' => $request->input, 'item' => $item];
        return view('find', $param);
    }

}

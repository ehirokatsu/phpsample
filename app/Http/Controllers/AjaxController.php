<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{

    //Ajax トップ画面
    public function ajax(){
        return view('ajax');
    }

    //一覧表示用GETの処理
    public function showAjaxAll () {

        $people = \DB::table('people')->get();

        $personList = array();
    
        foreach ($people as $person) {
            $personList[] = array(
              'id'    => $person->id,
              'name'  => $person->name,
              'mail' => $person->mail,
              'age' => $person->age
            );
        }
    
        // ヘッダーを指定することによりjsonの動作を安定させる
        header('Content-type: application/json');
    
        // htmlへ渡す配列$personListをjsonに変換する
        echo json_encode($personList);
    }

    //詳細表示用POSTの処理
    public function showAjax (Request $request){
        $id = $request->input('id');
        $people = \DB::table('people')->where('id',$id)->get();
    
        $personList = array();
        foreach ($people as $person) {
            $personList[] = array(
                'id'    => $person->id,
                'name'  => $person->name,
                'price' => $person->mail,
                'age' => $person->age
            );
        }
    
        header('Content-type: application/json');
        echo json_encode($personList);
    }

    //項目追加用POSTの処理
    public function addAjax (Request $request) {
        $name  = $request->input('name');
        $mail = $request->input('mail');
        $age = $request->input('age');
    
        // 追加
        $id = \DB::table('people')->insertGetId(
                ['name' => $name, 'mail' => $mail, 'age' => $age]
              );
    

        $people = \DB::table('people')->where('id',$id)->get();

        $personList = array();
    
        foreach ($people as $person) {
            $personList[] = array(
            'id'    => $person->id,
            'name'  => $person->name,
            'mail' => $person->mail,
            'age' => $person->age
            );
        }
        // ヘッダーを指定することによりjsonの動作を安定させる
        header('Content-type: application/json');

        // htmlへ渡す配列$personListをjsonに変換する
        echo json_encode($personList);
    }

    //項目削除用POSTの処理
    public function delAjax (Request $request) {

        $id = $request->input('id');

        // 削除レコード取得
        $people = \DB::table('people')->where('id',$id)->get();

        // 削除処理
        $count = \DB::table('people')->where('id',$id)->delete();

        $personList = array();
        foreach ($people as $person) {
            $personList[] = array(
                'id'    => $person->id,
                'name'  => $person->name,
                'mail' => $person->mail,
                'age' => $person->age
            );
        }


        $people = \DB::table('people')->get();

        $personList_all = array();
        foreach ($people as $person) {
            $personList_all[] = array(
                'id'    => $person->id,
                'name'  => $person->name,
                'mail' => $person->mail,
                'age' => $person->age
            );
        }
    
        $data['del_list'] = $personList;
        $data['all_list'] = $personList_all;
    
        // ヘッダーを指定することによりjsonの動作を安定させる
        header('Content-type: application/json');

        // htmlへ渡す配列$productListをjsonに変換する
        echo json_encode($data);

    }
}

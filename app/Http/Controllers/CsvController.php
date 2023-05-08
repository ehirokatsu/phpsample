<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CsvController extends Controller
{
    //php://tempを使用する方法
    public function get () {

        //ストリームを書き込みモードで開く
        $stream = fopen('php://temp', 'w');

        //CSVファイルのカラム（列）名の指定
        $columnsName = [
            'id',
            'name',
            'mail',
            'age',
        ];    

        //1行目にカラム（列）名のみを書き込む（繰り返し処理には入れない）
        fputcsv($stream, $columnsName);

        //書き込みたいデータを取得
        $people = DB::table('people')->select(['id', 'name', 'mail', 'age'])->get();

        //DBのデータを書き込む
        foreach ($people as $person) {

            //1行読み込む
            $csv = [
                $person->id,
                $person->name,
                $person->mail,
                $person->age,
            ];
            //1行分をストリームに書く
            fputcsv($stream, $csv);
        }
        
        //fputcsvで書き込まれた後のファイルポインタはファイルの終端になっているため
        //ファイルポインタを先頭に戻す
        rewind($stream);

        //ストリームの最初からデータを取得する
        $csv = stream_get_contents($stream);

        //$csvの文字エンコードをUTF-8からsjis-winに変更
        $csv = mb_convert_encoding($csv, 'sjis-win', 'UTF-8');

        //ストリームを閉じる
        fclose($stream);                      
        
        //ヘッダー情報を指定する（ダウンロード用の設定）
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=test.csv'
        );
        
        //HTTPレスポンスを生成
        //第1引数：コンテンツ
        //第2引数：レスポンスステータス
        //第3引数：レスポンスヘッダー
        return Response::make($csv, 200, $headers);

    }

    //php://outputを使用する方法
    public function get2 () {
        
        /************************************************************************
        ※Pragma：HTTP/1.0（HTTPの旧バージョン）のCache-Controlヘッダーを解さない場合に
        備えて利用するキャッシュ制御ヘッダー。 no-cacheを指定した場合、キャッシュを利用しない。

        ※Cache-Control：HTTPヘッダーのひとつで、キャッシュをブラウザやプロキシなどで
        制御するためのもの。今回のケースでは、有効期限切れ（Expiresで指定）の場合キャッシュを利用しない。

        ※Expires：HTTPレスポンスのヘッダー項目で、コンテンツのキャッシュ有効期限を表す。
        0のような無効な値の場合、リソースが既に有効期限切れであることを示す。

        *************************************************************************/
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=test.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () {

            //書き込み専用ストリーム
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'id',
                'name',
                'mail',
                'age',
            ];

            //変数の文字コードを変換する関数のことで、文字エンコーディングを変換させ文字化けを防止する。　　
            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $people = DB::table('people');


            $peopleData = $people->select(['id', 'name', 'mail', 'age'])->get();

            foreach ( $peopleData as $person ) {
                $csv = [
                    $person->id,
                    $person->name,
                    $person->mail,
                    $person->age,
                ];
                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };

        //ファイルのダウンロードを行うことができるresponse()関数のメソッドのひとつ。callback関数の指定が必要
        return response()->stream($callback, 200, $headers);

    }
}

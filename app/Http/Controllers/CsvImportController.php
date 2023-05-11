<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class CsvImportController extends Controller
{
    //
    public function index ()
    {
        return view('csvImport');
    }

    public function post (Request $request)
    {

        //アップロードしたCSVファイルのバリデーションと保存を行う
        $newCsvFileName = $this->saveUploadFile($request);

        //csvファイルをコレクション化する
        $boards = $this->createCsvCollection($newCsvFileName);
        
        //データの重複チェックをする
        $this->checkDuplicates($boards);

        //コレクションを配列に変換してDBに挿入する
        \DB::table('boards')->insert($boards->toArray());

    }


    /**************************************************
     * HTTPリクエストからアップロードされたファイルを取得。
     * 拡張子のチェックし保存する
     * @param  $request　HTTPリクエスト。アップロードファイル情報のみ使用
     * @return $newCsvFileName　保存したファイル名称
     ************************************************/
    public function saveUploadFile($request)
    {
        //アップロードファイルの存在確認
        if ($request->hasFile('csvFile')) {

            //ファイル拡張子がcsvか確認
            if ($request->csvFile->getClientOriginalExtension() !== "csv") {

                throw new Exception('不適切な拡張子です。');

            }

            //ファイル名を取得
            $newCsvFileName = $request->csvFile->getClientOriginalName();

            //アップロードファイルを保存する
            $request->csvFile->storeAs('public/csv', $newCsvFileName);

        } else {

            throw new Exception('CSVファイルの取得に失敗しました。');

        }

        return $newCsvFileName;
    }

    /**************************************************
     * 保存されているCSVファイルをコレクション化する。
     * @param  $newCsvFileName　保存したファイル名称
     * @return $boards　コレクション化したCSVファイル
     ************************************************/
    public function createCsvCollection ($newCsvFileName)
    {
        //保存したファイルを取得する
        $csv = \Storage::disk('local')->get("public/csv/{$newCsvFileName}");

        //異なる改行コードを統一する
        $csv = str_replace(array("\r\n","\r"), "\n", $csv);

        $uploadedData = collect(explode("\n", $csv));

        $board = new Board();

        //boardテーブルのカラム
        $header = collect($board->csvHeader());
        
        //アップロードしたCSVの1行目を取得しカンマで区切ってコレクション化する
        $uploadedHeader = collect(explode(",", $uploadedData->first()));

        if ($header->count() !== $uploadedHeader->count()) {
            
            throw new Exception('Error: カラムの数が一致しません');

        }

        //アップロードしたCSVをカンマ区切りでコレクション化
        try {
            
            $boards = $uploadedData->map(fn($oneRecord) => $header->combine(collect(explode(",", $oneRecord))));

        } catch (Exception $e) {

            throw new Exception('Error: ヘッダーが一致しません');
        }

        return $boards;

    }


    /**************************************************
     * CSVファイル内の重複チェックと、DBとの重複チェックを行う
     * @param  $boards　コレクション化したCSVファイル
     * @return 無し
     ************************************************/
    public function checkDuplicates ($boards)
    {
        //アップロードしたCSVにてidの重複チェック
        if ($boards->duplicates("id")->count() > 0) {
            throw new Exception("Error:idの重複：" . $boards->duplicates("id")->shift());

        }

        //既存データとの重複チェック
        $duplicateBoard = \DB::table('boards')->whereIn('id', $boards->pluck('id'));
        if ($duplicateBoard->count() > 0) {
            throw new Exception("Error:idの重複：" . $duplicateBoard->shift()->id);
        }
    }
}

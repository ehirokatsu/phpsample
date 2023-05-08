<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
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

        //保存したファイルを取得する
        $csv = Storage::disk('local')->get("public/csv/{$newCsvFileName}");

        //異なる改行コードを統一する
        $csv = str_replace(array("¥r¥n","¥r"), "¥n", $csv);

        $uploadedData = collect(explode("¥n", $csv));

        $board = new Board();

    }
}

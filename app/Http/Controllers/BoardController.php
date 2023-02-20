<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        //$items = Board::all();

        //personをBoardモデルで定義しておく必要あり
        $items = Board::with('person')->get();
        return view('board.index', ['items' => $items]);
    }

    public function add(Request $request)
    {
        return view('board.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Board::$rules);
        $board = new Board;
        $form = $request->all();
        unset($form['_token']);
        $board->fill($form)->save();
        return redirect('/board');
    }

    public function index_dbclass(Request $request)
    {
        //DBクラス
        //$items = DB::select('select * from people A, boards B where A.id = B.person_id');
        
        //クエリビルダ
        $items = DB::table('people')
        ->join('boards', 'people.id', '=', 'boards.person_id')
        ->get();

        return view('board.index_dbclass', ['items' => $items]);
    }
}

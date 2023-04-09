@extends('layouts.helloapp')

@section('title', 'Board.index')

@section('menubar')
   @parent
   ボード・ページ
@endsection

@section('content')
   <table>
   <tr><th>Data</th></tr>
   @foreach ($items as $item)
       <tr>
           <td>{{$item->getData()}}</td>
           <!--$item->person->getData()としてpersonモデルのgetDataも使用可能-->
       </tr>
   @endforeach
   </table>
   <a href="/board/add" class="">追加</a>
   <a href="/index_db" class="">戻る</a>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

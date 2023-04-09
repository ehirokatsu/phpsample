@extends('layouts.helloapp')

@section('title', 'dbclassテスト')

@section('content')
   <table>
   <tr><th>Id</th><th>Name</th><th>Mail</th><th>Age</th></tr>
   @foreach ($items as $item)
       <tr>
           <td>{{$item->id}}</td>
           <td>{{$item->name}}</td>
           <td>{{$item->mail}}</td>
           <td>{{$item->age}}</td>
           <td><a href="/edit?id={{ $item->id }}" class="">編集</a></td>
           <td><a href="/del?id={{ $item->id }}" class="">削除</a></td>
       </tr>
   @endforeach
   </table>
   <a href="/add" class="">追加</a>
   <a href="/find" class="">検索</a>
   <a href="/board" class="">投稿テーブル</a>
   <a href="/" class="">戻る</a>
   <table>
   <tr><th>Person</th><th>Board</th></tr>
   @foreach ($items as $item)
       <tr>
           <td>{{$item->getData()}}</td>
           <td>
           @if ($item->boards != null)
               <table width="100%">
               @foreach ($item->boards as $obj)
                   <tr><td>{{$obj->getData()}}</td></tr>
               @endforeach
               </table>
           @endif
           </td>
       </tr>
   @endforeach
   </table>

@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

@section('test')
@parent
dbclassのテストページ
@endsection
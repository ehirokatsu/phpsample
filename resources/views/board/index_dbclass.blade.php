@extends('layouts.helloapp')

@section('title', 'Board.index')

@section('menubar')
   @parent
   ボード・ページ
@endsection

@section('content')
<table>
   <tr><th>Id</th><th>Name</th><th>Mail</th><th>Age</th><th>Title</th></tr>
   @foreach ($items as $item)
       <tr>
           <td>{{$item->id}}</td>
           <td>{{$item->name}}</td>
           <td>{{$item->mail}}</td>
           <td>{{$item->age}}</td>
           <td>{{$item->title}}</td>
                </tr>
   @endforeach
   </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

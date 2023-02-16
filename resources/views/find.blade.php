@extends('layouts.helloapp')

@section('title', 'find')

@section('menubar')
   @parent
   検索ページ
@endsection

@section('content')
   <form action="/find" method="post">
   @csrf
   <input type="text" name="input" value="{{$input}}">
   <input type="submit" value="find">
   </form>
   @if (isset($item))
   <table>
   <tr><th>Data</th></tr>
   <tr>
      <td>{{$item->name}}</td>
   </tr>
   </table>
   @endif
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

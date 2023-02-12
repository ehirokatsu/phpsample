@extends('layouts.helloapp')

@section('title', 'HelloMiddlenのテスト')

@section('content')
<p>ここが本文のコンテンツです。</p>
   <table>
   @foreach($data as $item)
   <tr><th>{{$item['name']}}</th><td>{{$item['mail']}}</td></tr>
   @endforeach
   </table>
@endsection

@section('footer')
copyright 2022 tuyano2.
@endsection

@section('test')
@parent
HelloMiddleのテストページ
@endsection

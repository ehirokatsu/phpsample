@extends('layouts.helloapp')

@section('title', 'section（ビューコンポーザ）テスト')

@section('content')
   <p>ここが本文のコンテンツです。</p>
   <p>必要なだけ記述できます。</p>
   <p>Controller value<br>'message' = {{$message}}</p>
   <p>ViewComposer value<br>'view_message' = {{$view_message}}</p>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
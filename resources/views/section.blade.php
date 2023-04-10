@extends('layouts.helloapp')

@section('title', 'section（ビューコンポーザ）テスト')

@section('content')
   <p>以下のmessageはreturn view時に渡す</p>
   <p>Controller value<br>'message' = {{$message}}</p>
   <p>以下のview_messageはHttp/Composers/HelloComposer.phpから渡す</p>
   <p>ViewComposer value<br>'view_message' = {{$view_message}}</p>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

@section('test')
section、ビューコンポーザのテストページ
@endsection
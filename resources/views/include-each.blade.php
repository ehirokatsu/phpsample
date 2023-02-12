@extends('layouts.helloapp')

@section('title', 'include-eachのテスト')

@section('content')
   <p>ここは別のページです</p>
   @include('message', ['msg_title'=>'OK', 
      'msg_content'=>'サブビューです。'])

   <ul>
   @each('item', $data, 'item')
   </ul>
@endsection

@section('footer')
copyright 2022 tuyano2.
@endsection

@section('test')
@parent
include-eachのテストページ
@endsection

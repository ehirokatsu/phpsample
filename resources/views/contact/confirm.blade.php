@extends('contact.layout')

@section('title', '確認画面')

@section('content')
  <form method="post" action="{{ route('contact.send') }}">
    @csrf
    <label for="">メールアドレス</label>
    {{ $inputs['email'] }}
    <input type="hidden" name="email" value="{{ $inputs['email'] }}">

    <br>
    <label for="">タイトル</label>
    {{ $inputs['title'] }}
    <input type="hidden" name="title" value="{{ $inputs['title'] }}">

    <br>
    <label for="">お問い合わせ内容</label>
    <!--改行コードをそのまま出力し、エスケープ処理を行う-->
    {!! nl2br(e($inputs['body'])) !!}
    <input type="hidden" name="body" value="{{ $inputs['body'] }}">

    <br>
    <button type="submit" name="action" value="back">入力内容確認</button>
    <button type="submit" name="action" value="submit">送信する</button>
    
  </form>
@endsection
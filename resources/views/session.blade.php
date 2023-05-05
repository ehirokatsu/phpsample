@extends('layouts.helloapp')

@section('title', 'sessionのテスト')

@section('content')
  <p>{{ $session_data }}</p>
  <form method="post" action="{{ route('session.put') }}">
    @csrf
    <input type="text" name="input">
    <input type="submit" value="send">
  </form>
@endsection

@section('footer')
copyright 2022 tuyano2.
@endsection

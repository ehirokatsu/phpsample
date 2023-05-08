@extends('layouts.helloapp')

@section('title', 'CSVインポート')

@section('content')
<h1>CSVインポート</h1>
<form action="/answer" method="post">
  @csrf
  A:<input type="radio" name="radioGroup" id="A" value="{{$A}}">
  B:<input type="radio" name="radioGroup" id="B" value="{{$B}}">
  <input type="submit" value="回答する">
</form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

@extends('layouts.helloapp')

@section('title', 'CSVインポート')

@section('content')
<h1>CSVインポート</h1>
<form action="{{ route('csvImport.post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <label for="" name="csvFile">CSVファイル</label>
  <input type="file" name="csvFile" id="csvFile">
  <input type="submit" value="">
</form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection

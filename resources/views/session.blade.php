@extends('layouts.helloapp')

@section('title', 'sessionのテスト')

@section('content')
  @if (!empty($session_data))
    @foreach($session_data as $data)
      <p>{{ $data['id'] }} {{ $data['num'] }}</p>
      <form action="/{{ $data['id'] }}" method="post" style="margin: auto;">
        @method('DELETE')
        @csrf
        <input type="submit" value="削除">
      </form>
    @endforeach
  @endif
  <form method="post" action="{{ route('session.put') }}">
    @csrf
    <label for="">商品A</label>
    <input type="text" name="input">
    <label for="">個数</label>
    <input type="text" name="input_num">
    <br>
    <input type="submit" value="追加">
  </form>
  <form method="post" action="{{ route('session.put') }}">
    <label for="">商品B</label>
    <input type="text" name="input2">
    <label for="">個数</label>
    <input type="text" name="input2_num">
    <br>
    <input type="submit" value="追加">
  </form>
@endsection

@section('footer')
copyright 2022 tuyano2.
@endsection

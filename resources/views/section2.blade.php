@extends('layouts.helloapp')

@section('title', 'Other')

@section('content')
   <p>ここは別のページです</p>
@endsection

@section('footer')
copyright 2022 tuyano2.
@endsection

@section('test')
@parent
ttttt
@endsection

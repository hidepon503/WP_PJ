@extends('user.catShow')
@section('title', '死亡報告完了')
@section('catManu')
  @include('user.component.complete-component', [
    'applicationTitle' => '死亡報告完了',
    'message' => 'ねこの死亡報告を行いました。'
    ])
@endsection



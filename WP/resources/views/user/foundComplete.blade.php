@extends('user.catShow')
@section('title', '死亡報告完了')
@section('catManu')
  @include('user.component.complete-component', [
    'applicationTitle' => '発見報告完了',
    'message' => 'ねこの発見報告を行いました。'
    ])
@endsection



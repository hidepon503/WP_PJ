@extends('user.catShow')
@section('title', '死亡報告')
@section('catManu')
@include('user.component.application-component', [
  'applicationTitle' => '死亡報告',
  'applicationText' => 'ねこの死亡報告を行います。',
  'action' => 'comeback.request',
  'value' => '9',
  ])
@endsection



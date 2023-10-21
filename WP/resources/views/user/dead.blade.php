@extends('user.catShow')
@section('title', '死亡報告')
@section('catManu')
@include('user.component.application-component', [
  'applicationTitle' => '看取り報告',
  'applicationText' => 'ねこを看取った報告を行います。',
  'action' => 'dead.request',
  'value' => '9',
  ])
@endsection



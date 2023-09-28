@extends('user.catShow')
@section('title', '迷子発見報告')
@section('catManu')
@include('user.component.application-component', [
  'applicationTitle' => '迷子発見報告',
  'applicationText' => '迷子だったねこの発見報告を行います。',
  'action' => 'comeback.request',
  'value' => '8',
  ])
@endsection



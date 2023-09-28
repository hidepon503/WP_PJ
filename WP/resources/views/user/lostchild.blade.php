@extends('user.catShow')
@section('title', '迷子申請')
@section('catManu')
@include('user.component.application-component', [
  'applicationTitle' => '迷子申請',
  'applicationText' => 'ねこの迷子申請を行います。',
  'action' => 'lostchild.request',
  'value' => '6',
  ])
@endsection
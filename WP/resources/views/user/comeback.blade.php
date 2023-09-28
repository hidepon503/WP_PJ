@extends('user.catShow')
@section('title', '引取り申請')
@section('catManu')
@include('user.component.application-component', [
  'applicationTitle' => '引取り申請',
  'applicationText' => 'ねこの引取り申請を行います。',
  'action' => 'comeback.request',
  'value' => '4',
  ])
@endsection



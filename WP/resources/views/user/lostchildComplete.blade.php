@extends('user.catShow')
@section('title', '引取り申請完了')
@section('catManu')
  @include('user.component.complete-component', [
    'applicationTitle' => '迷子申請完了',
    'message' => 'ねこの迷子申請を行いました。'
    ])
@endsection



@extends('layouts.admin')

@section('title', '返却申請管理') 

@section('content')
@include('admin.management-component', [
  'managementTitle' => '引取り申請一覧',
  'app' => 'return.approve'
  ])

@endsection
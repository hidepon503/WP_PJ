@extends('layouts.admin')

@section('title', '迷子申請管理') 

@section('content')
@include('admin.management-component', [
  'managementTitle' => '迷子申請一覧',
  'app' => 'lost.approve'

  ])

  

@endsection
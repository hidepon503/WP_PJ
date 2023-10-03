@extends('layouts.admin')

@section('title', '迷子申請管理') 

@section('content')
@include('admin.management-component', [
  'managementTitle' => '発見報告一覧',
  'app' => 'found.approve'
  ])

@endsection
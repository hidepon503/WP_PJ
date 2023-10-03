@extends('layouts.admin')

@section('title', '迷子申請管理') 

@section('content')
@include('admin.management-component', [
  'managementTitle' => '看取り報告一覧',
  'app' => 'death.approve'
  ]);

@endsection
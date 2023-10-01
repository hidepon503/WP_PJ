@extends('layouts.admin')
@section('title', '登録猫一覧')

@section('content')
<section class="bg-gray-100">
  <div class="container mx-auto">
    <p class="text-left px-4 pt-2">　</p>
    <p class="text-center pt-10 text-2xl"></p>
    <h1 class="mt-2 text-4xl font-bold font-heading text-center h-32">登録猫一覧</h1>
  </div>
</section>

<section>
    @include('cats.component.catIndex')
</section>
@endsection
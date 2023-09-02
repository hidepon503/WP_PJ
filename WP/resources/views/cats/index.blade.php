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
<section class="">
    <div class="container mx-auto">
        <a href="/admin/cats/create">
            <button class="mt-6 text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded py-4 w-full" type="submit">保護猫新規登録</button>
        </a>
    </div>
</section>

<section class="py-20 bg-blueGray-50">
  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap">
        @foreach($cats as $cat)
            <div class="w-full md:w-1/2 py-5 md:px-5">
                <div class="px-6 bg-white shadow rounded h-full py-10">
                    <div class="flex items-center mb-4">
                        <!-- 仮定として、CatImageモデルと関連付けがされており、最初の画像を取得できるとします -->
                        <img class="h-16 w-16 rounded-full object-cover" src="" alt="{{ $cat->name }}">
                        <div class="pl-4">
                            <p class="text-xl">{{ $cat->name }}</p>
                            <!-- 仮定として、genderとkindの関係も設定されているとします -->
                            <p class="text-blueGray-400">{{ $cat->kind->kind }}({{ $cat->gender->gender }}{{ $cat->age }}さい)</p>
                        </div>
                    </div>
                    <p class="leading-loose text-blueGray-400 mb-5 whitespace-pre-line">
                        <!-- 何かのテキスト情報を表示したい場合、以下のようにすることができます -->
                        {{ $cat->description }} 
                    </p>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</section>
@endsection
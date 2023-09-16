@extends('user.home')
@section('title', 'HOME')
@section('content')

@if(!$user_cats->isEmpty())  {{-- $user_catsにデータが存在する場合 --}}
<section class="section1">
<!-- Team -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">My Pets</h2>
  </div>
  <!-- End Title -->

  <!-- Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 md:gap-12">
        @foreach ($user_cats as $user_cat)
        <div class="text-center">
            <img class="rounded-xl sm:w-48 sm:h-48 lg:w-60 lg:h-60 mx-auto" src="{{ asset('storage/images/cats/' .$user_cat->cat->image )}}" alt="Cat Image">
            <div class="mt-2 sm:mt-4">
                <h3 class="text-sm font-medium text-gray-800 sm:text-base lg:text-lg dark:text-gray-200">
                    {{ $user_cat->cat->name }}
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm lg:text-base dark:text-gray-400">
                    {{-- 猫のプロフィール情報 --}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
  <!-- End Grid -->
</div>
<!-- End Team -->
</section>

@else {{-- $user_catsにデータが存在しない場合 --}}
<section class="section2 py-20 bg-blueGray-50">
    <div class="container px-4 mx-auto">
        <h2>新着登録猫一覧</h2>
        <div class="flex flex-wrap">
            @foreach($cats as $cat)
                <div class="catcontainer w-full md:w-1/4 py-5 md:px-5">
                    <a href="{{ route('cat.show', $cat->id) }}" class="">
                        <div class=" px-2 bg-white shadow rounded h-56 py-6">
                            <div class="flex flex-col justify-center items-center  mb-4">
                                <!-- 仮定として、CatImageモデルと関連付けがされており、最初の画像を取得できるとします -->
                                <img class="h-24 w-24 mb-2 rounded-full object-cover" src="{{ asset('storage/images/cats/' . $cat->image) }}" alt="{{ $cat->name }}">
                                <div class="">
                                    <p class="text-l text-center">{{ $cat->name }}</p>
                                    <!-- 仮定として、genderとkindの関係も設定されているとします -->
                                    <p class="text-blueGray-400 text-center text-xs">{{ $cat->kind->kind }}</p>
                                    <p class="text-xs text-center text-blueGray-400">{{ $cat->age }}歳  ({{ $cat->gender->gender }})</p>
                                </div>
                            </div>
                            <p class="leading-loose text-blueGray-400 mb-5 whitespace-pre-line">
                                <!-- 何かのテキスト情報を表示したい場合、以下のようにすることができます -->
                                {{ $cat->description }} 
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<h2>動物保護団体更新情報</h2>
@endsection
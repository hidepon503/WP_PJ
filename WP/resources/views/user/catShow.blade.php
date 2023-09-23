@extends('user.home')
@section('title', 'CAT DATA')
@section('content')
<section class="section1">
  <div class="flex flex-col rounded-xl p-4 md:p-6 bg-white">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">My Pets</h2>
            <div class="flex pl-6 pt-12 items-center gap-x-4">
                <img class="rounded-full w-40 h-40" src="{{ asset('storage/images/cats/' .$matching->cat->image )}}" alt="$user_cat->cat->name">
                <div class="grow pl-6">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">
                        {{ $matching->cat->name }}
                        <span class="ml-2">{{ $matching->cat->gender->gender }}</span>
                        <span class="ml-2">{{ $age }}歳</span>
                    </h3>
                    <p class="text-xs mb-4 uppercase text-gray-500">
                        登録保護団体：{{ $matching->cat->admin->name  }}
                        <span class="ml-4">契約状況：{{ $matching->request->answer }}</span>
                    </p>
                    <p>種類：{{ $matching->cat->kind->kind }}</p>
                    <p>生年月日：{{ $matching->cat->birthday }}
                        <span class="ml-4">体重：{{ $matching->cat->weight }}kg</span>
                    </p>
                    <p class="mt-3 text-gray-500">
                        {{ $matching->cat->introduction }}
                    </p>
                </div>
            </div>

            
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-4 mx-auto">
                  <div class="flex flex-col text-center w-full ">
              {{-- メニューバー --}}
                    <div class="text-gray-600 body-font">
                      <div class="container mx-auto flex flex-wrap pt-5 flex-col md:flex-row items-center">
                        <nav class="md:ml-auto  md:mr-auto flex flex-wrap items-center text-base justify-center">
                            <a href='{{ route('matching.show', ['cat' => $matching->cat->id, 'user' => auth() -> id()])  }}' class="hover:text-gray-900">
                                <div class="w-30">ポスト一覧</div>
                            </a>
                            <a href='' class="hover:text-gray-900">
                                <div class="w-30 mx-24">チャット</div>
                            </a>
                            <a href='' class="hover:text-gray-900">
                                <div class="w-30 mr-24">診察履歴</div>
                            </a>
                            <a href='{{ route('application', ['cat' => $matching->cat->id, 'user' => auth() -> id()])  }}' class="hover:text-gray-900">
                                <div class="w-30">各種申請</div>
                            </a>
                        </nav>
                        </div>
                      </div>
                    </div>
                  </div>
            @yield('catManu')
  </div>
@endsection

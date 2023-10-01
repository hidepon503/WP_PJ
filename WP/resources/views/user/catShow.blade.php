@extends('user.home')
@section('title', 'CAT DATA')
@section('content')
<section class="section1">
  <div class="flex flex-col rounded-xl p-4 md:p-6 bg-white">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">My Pets</h2>
            @include('user.component.catShow')

            
            <section class="text-gray-600 body-font">
            <div class="container px-5 py-4 mx-auto">
                <div class="flex flex-col text-center w-full ">
                {{-- メニューバー --}}
                    <div class="text-gray-600 body-font  flex justify-center items center ">
                        <div class="container mx-auto text-align flex flex-wrap justify-center py-3 flex-col bg-gray-100 md:flex-row items-center rounded-full">
                            <nav class=" md:ml-auto  md:mr-auto flex flex-wrap justify-center items-center text-base ">
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

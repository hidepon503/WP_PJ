@extends('layouts.admin')
@section('title', '猫の詳細ページ')

@section('content')

    <div class="px-6 bg-white shadow rounded h-full py-10">
{{-- @include('cats.component.catShow') --}}
<div class="flex pl-6 pt-12 items-center gap-x-4 ">
    <div class="w-40 h-40 rounded-full overflow-hidden">
        <img class="w-full h-full object-cover" src="{{ asset('storage/images/cats/' .$cat->image )}}" alt="$cat->name">
    </div>
    <div class="grow pl-6">
        <h3 class="font-medium text-gray-800 dark:text-gray-200">
            {{ $cat->name }}
            <span class="ml-2">{{ $cat->gender->gender }}</span>
            <span class="ml-2">{{ $age }}歳</span>
        </h3>
        <p class="text-xs mb-4 uppercase text-gray-500">
            契約状況：{{ $cat->status->name  }}
            <span class="ml-4">ユーザー：</span>
            @if(isset($userByCat[$cat->id]))
                <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                    <span>
                        ユーザー：{{ $userByCat[$cat->id]->name }}
                    </span>
                </span>
            @else
                <span>未定</span>
            @endif
        </p>
        <p>種類：{{ $cat->kind->kind }}</p>
        <p>生年月日：{{ $cat->birthday }}
            <span class="ml-4">体重：{{ $cat->weight }}kg</span>
        </p>
        <p class="mt-3 text-gray-500">
            {{ $cat->introduction }}
        </p>
    </div>
</div>
{{-- @include('cats.component.manu') --}}
{{-- メニューバー --}}
  <div class="text-gray-600 mt-4 px-8 body-font">
    <div class="container mx-auto text-align flex flex-wrap justify-center py-3 flex-col bg-gray-100 md:flex-row items-center rounded-full">
      <nav class=" md:ml-auto  md:mr-auto flex flex-wrap items-center text-base justify-center">
          <a href='{{ route('cat.show', $cat->id)  }}' class="hover:text-gray-900">
              <div class="w-30">ポスト一覧</div>
          </a>
          <a href='{{ route('cat.chat', [$cat->id , 'admin'=> $cat->admin->id, ]) }}' class="hover:text-gray-900">
              <div class="w-30 mx-24">ユーザー情報</div>
          </a>
          <a href='{{ route('edit.cats', $cat->id) }}' class="hover:text-gray-900">
              <div class="w-30">編集</div>
          </a>
      </nav>
    </div>
  </div>
{{-- @include('cats.component.createButton') --}}
<div class="container mx-auto mb-6">
    <a href="{{ route("postCat.create", ['cat' => $cat->id]) }}">
        <button class="mt-6 text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded py-4 w-full" type="submit">新規投稿</button>
    </a>
</div>
@include('cats.component.postIndex')





@endsection
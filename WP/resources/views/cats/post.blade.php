@extends('layouts.admin')
@section('title', '猫の投稿ページ')

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
            
            <span class="mr-4">契約状況：
            {{ $cat->status->name  }}
            </span>
            @if(isset($userByCat[$cat->id]))
                <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                    <span>
                        ユーザー：{{ $userByCat[$cat->id]->name }}
                    </span>
                </span>
            @else
                <span>ユーザー：未定</span>
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

        @include('cats.component.manu')
{{-- メニューバー --}}

        @include('cats.component.postStore')







@endsection
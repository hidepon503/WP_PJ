@extends('layouts.admin')
@section('title', '猫の投稿ページ')

@section('content')

    <div class="px-6 bg-white shadow rounded h-full py-10">
        {{-- @include('cats.component.catShow') --}}
<div class="flex pl-6 pt-12 items-center gap-x-4 ">
    <div class="w-40 h-40 rounded-full overflow-hidden">
        <img class="w-full h-full object-cover" src="{{ asset('storage/images/cats/' .$matching->cat->image )}}" alt="$matching->cat->name">
    </div>
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
                  

        {{-- @include('cats.component.postStore') --}}
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{ route('post.store', ['cat' => $cat->id])  }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex px-6 pb-4">
                    <h3 class="text-xl font-bold">新規投稿</h3>
                    <div class="ml-auto">
                        <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">保存</button>
                    </div>
                </div>

                <div class="pt-4 px-6">
                    <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->
                    @if ($errors->any())
                        <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-400">{{ $error }}</li> 
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">タイトル</label>
                        <input id="name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text" name="title" value="{{ old('title') }}">
                    </div>
                    {{-- 紹介文 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="body">本文</label>
                        <textarea id="body" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="body" rows="5">{{ old('body') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="image">画像</label>
                        <div class="flex items-end">
                            <img id="previewImage" src="/images/admin/noimage.jpg" data-noimage="/images/admin/noimage.jpg" alt="" class="rounded shadow-md w-64">
                            <input id="media" class="block w-full px-4 py-3 mb-2" type="file" accept='image/*,video/*' name="media[]" multiple>
                        </div>
                    </div>
                    {{-- cat_idの送信リクエスト --}}
                    <input type="hidden" name="cat_id" value="{{ $cat ->id }}">
                </div>
            </form>
        </div>
    </div>
</section>
    </div>





@endsection
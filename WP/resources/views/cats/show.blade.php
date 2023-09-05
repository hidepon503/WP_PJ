@extends('layouts.admin')
@section('title', '{{ $cat->name }}.のページ')

@section('content')
  <div class="px-6 bg-white shadow rounded h-full py-10">
      {{-- 編集ボタン --}}
      <div class="ml-auto flex justify-end">
          <a href="{{ route('edit.cats', $cat->id) }}" class="mr-2">
              <button class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">編集</button>
          </a>
      </div>
      <div class="mb-4 flex">
          <!---->
          <img class="h-64 w-64 rounded-full object-cover" src="{{ asset('storage/images/cats/' . $cat->image) }}" alt="{{ $cat->name }}">
          <div class="pl-16 ">
            {{-- CSSグリッドを利用した２カラムレイアウトで、猫の詳細を表示 --}}
            <div class="grid grid-cols-4 gap-x-16 gap-y-8 text-2xl">
                <label for="cat-name" class="grid-item col-span-1 font-bold">名前</label>
                <div id="cat-name" class="grid-item col-span-3">{{ $cat->name }}</div>

                <label for="cat-admin-name" class="grid-item col-span-1 font-bold">登録団体名</label>
                <div id="cat-admin-name" class="grid-item col-span-3">{{ $cat->admin->name }}</div>

                <label for="cat-gender" class="grid-item col-span-1 font-bold">性別</label>
                <div id="cat-gender" class="grid-item col-span-3">{{ $cat->gender->gender }}</div>

                <label for="cat-kind" class="grid-item col-span-1 font-bold">種類</label>
                <div id="cat-kind" class="grid-item col-span-3">{{ $cat->kind->kind }}</div>

                <label for="cat-birthday" class="grid-item col-span-1 font-bold">生年月日</label>
                <div id="cat-birthday" class="grid-item col-span-3">{{ $cat->birthday }}</div>

                <label for="cat-age" class="grid-item col-span-1 font-bold">年齢</label>
                <div id="cat-age" class="grid-item col-span-3">{{ $age }}歳</div>

                <label for="cat-weight" class="grid-item col-span-1 font-bold">体重</label>
                <div id="cat-weight" class="grid-item col-span-3">{{ $cat->weight }}kg</div>

                <label for="cat-introduction" class="grid-item col-span-1 font-bold">紹介文</label>
                <div id="cat-introduction" class="grid-item col-span-3">{{ $cat->introduction }}</div>

                <!-- 将来的に導入したいカラム -->
                <!-- 以下のカラムはコメントアウトされていたので、同様にコメントアウトしています -->
                {{-- 
                <label for="cat-color" class="grid-item col-span-1 font-bold">毛色</label>
                <div id="cat-color" class="grid-item col-span-3">{{ $cat->color }}</div>
                
                <label for="cat-feature" class="grid-item col-span-1 font-bold">特徴</label>
                <div id="cat-feature" class="grid-item col-span-3">{{ $cat->feature }}</div>
                
                <label for="cat-personality" class="grid-item col-span-1 font-bold">性格</label>
                <div id="cat-personality" class="grid-item col-span-3">{{ $cat->personality }}</div>
                
                <label for="cat-health" class="grid-item col-span-1 font-bold">健康状態</label>
                <div id="cat-health" class="grid-item col-span-3">{{ $cat->health }}</div>
                
                <label for="cat-vaccine" class="grid-item col-span-1 font-bold">ワクチン接種</label>
                <div id="cat-vaccine" class="grid-item col-span-3">{{ $cat->vaccine }}</div>
                
                <label for="cat-castration" class="grid-item col-span-1 font-bold">去勢・避妊手術</label>
                <div id="cat-castration" class="grid-item col-span-3">{{ $cat->castration }}</div>
                
                <label for="cat-owner-name" class="grid-item col-span-1 font-bold">飼い主名</label>
                <div id="cat-owner-name" class="grid-item col-span-3">{{ $cat->$user_id->name }}</div>
                
                <label for="cat-owner-email" class="grid-item col-span-1 font-bold">飼い主のEmail</label>
                <div id="cat-owner-email" class="grid-item col-span-3">{{ $cat->$user_id->email }}</div>
                
                <label for="cat-owner-tel" class="grid-item col-span-1 font-bold">飼い主の電話番号</label>
                <div id="cat-owner-tel" class="grid-item col-span-3">{{ $cat->$user_id->tel }}</div>
                
                <label for="cat-owner-postalcode" class="grid-item col-span-1 font-bold">飼い主の郵便番号</label>
                <div id="cat-owner-postalcode" class="grid-item col-span-3">{{ $cat->$user_id->postalcode }}</div>
                
                <label for="cat-owner-address" class="grid-item col-span-1 font-bold">飼い主の住所</label>
                <div id="cat-owner-address" class="grid-item col-span-3">{{ $cat->$user_id->address }}</div>
                --}}
            </div>
          </div>
      </div>



@endsection
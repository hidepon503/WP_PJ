@extends('layouts.admin')
@section('title', '{{ $cat->name }}.の編集ページ')

@section('content')
  <div class="px-6 bg-white shadow rounded h-full py-10">
    <form action="{{ route('update.cats',$cat->id) }}" method='post' enctype="multipart/form-data" >
        @csrf
        {{-- 完了ボタン --}}
        <div class="ml-auto flex justify-end">
            <button class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">完了</button>
        </div>

        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        {{-- エラーメッセージここまで --}}
        
        <div class="mb-4 flex">
            <!---->
            {{-- <img class="h-80 w-80 rounded-full object-cover" src="{{ asset('storage/images/cats/' . $cat->image) }}" alt="{{ $cat->name }}"> --}}
            <div class="">
                <img id="previewImage" src="{{ asset('storage/images/cats/' . $cat->image) }}" data-noimage="/images/admin/noimage.jpg" alt="写真" class="rounded shadow-md w-64">
                <input id="image" class="block w-full px-4 py-3 mb-2" type="file" accept='image/*' name="image" >
            </div>

            <div class="pl-16 ">
                {{-- CSSグリッドを利用した２カラムレイアウトで、猫の詳細を表示 --}}
                <div class="grid grid-cols-4 gap-x-16 gap-y-8 text-2xl">
                
                    <label for="cat-name" class="grid-item col-span-1 font-bold">名前</label>
                    <input type="text" id="cat-name" name="name" value="{{ old('cat_name', $cat->name) }}" class="grid-item col-span-3 border bg-gray-100 shadow-md">
                
                    <label for="cat-admin-name" class="grid-item col-span-1 font-bold">登録団体名</label>
                    <div id="cat-admin-name" class="grid-item col-span-3">{{ $cat->admin->name }}</div>
                
                    <label for="cat-gender" class="grid-item col-span-1 font-bold">性別</label>
                    <div class="grid-item col-span-3 flex space-x-4">
                        @foreach($genders as $gender)
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="cat-gender-{{ $gender->id }}" name="gender_id" value="{{ $gender->id }}" class="border bg-gray-100" {{ $cat->gender_id == $gender->id ? 'checked' : '' }}>
                                <label for="cat-gender-{{ $gender->id }}">{{ $gender->gender }}</label>
                            </div>
                        @endforeach
                    </div>
                
                    <label for="cat-kind" class="grid-item col-span-1 font-bold">種類</label>
                    <select id="category" class="grid-item col-span-3 border bg-gray-100 shadow-md" name="kind_id">
                        @foreach($kinds as $kind)
                            <option value="{{ $kind->id }}" {{ $cat->kind_id == $kind->id ? 'selected' : '' }}>{{ $kind->kind }}</option>
                        @endforeach
                    </select>
                
                    <label for="cat-birthday" class="grid-item col-span-1 font-bold">生年月日</label>
                    <input type="date" id="cat-birthday" name="birthday" value="{{ old('birthday', $cat->birthday) }}" class="grid-item col-span-3 border bg-gray-100 shadow-md">
                
                    <label for="cat-weight" class="grid-item col-span-1 font-bold">体重</label>
                    <div class="grid-item col-span-3 relative">
                        <input type="number" id="cat-weight" name="weight" step="0.01" value="{{ old('weight', $cat->weight) }}" class="border bg-gray-100 shadow-md w-full pl-3 pr-8">
                        <span class="absolute inset-y-0 right-2 text-gray-600 flex items-center">kg</span>
                    </div>
                
                    <label for="cat-introduction" class="grid-item col-span-1 font-bold">紹介文</label>
                    <textarea id="cat-introduction" name="introduction" class="grid-item col-span-3 border bg-gray-100 shadow-md">{{ old('introduction', $cat->introduction) }}</textarea>
                    <label for="">公開設定</label>
                    <select id="category" class="grid-item col-span-3 border bg-gray-100 shadow-md" name="status_id">
                            <option value="2">募集中</option>
                            <option value="1">準備中</option>
                    </select>

                
                    
                
                </div>
                </div>
            </div>
        </div>
    </form>
            
            
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('previewImage').src = event.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection
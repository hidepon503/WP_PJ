@extends('layouts.admin')
@section('title', '保護猫新規登録')
@section('content')
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{ route('store.cats') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex px-6 pb-4 border-b">
                    <h3 class="text-xl font-bold">保護猫登録</h3>
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
                        <label class="block text-sm font-medium mb-2" for="title">猫の名前</label>
                        <input id="name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="image">画像</label>
                        <div class="flex items-end">
                            <img id="previewImage" src="/images/admin/noimage.jpg" data-noimage="/images/admin/noimage.jpg" alt="" class="rounded shadow-md w-64">
                            <input id="image" class="block w-full px-4 py-3 mb-2" type="file" accept='image/*' name="image" >
                        </div>
                    </div>
                    {{-- admin_idの送信リクエスト --}}
                    <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}">
                    {{-- lostchild --}}
                    {{-- <input type="hidden" name="lostchild" value="{{ $cat->false }}"> --}}



                    <div class="flex mt-12 mb-6">
                        <div class="flex items-center mr-20">
                            <label class="block mr-6 text-sm font-medium mb-2" for="image">性別</label>
                            @foreach($genders as $gender)
                                <label>
                                    <input type="radio" name="gender_id" value="{{ $gender->id }}" required class="ml-10 mr-2">
                                    {{ $gender->gender }}  <!-- 例えば、gendersテーブルがnameカラムを持っている場合 -->
                                </label>
                            @endforeach
                        </div>
                    
                        {{-- 種類 --}}
                        <label class="block text-sm font-medium mr-2" for="category">種類</label>
                        <div class="flex">
                        {{-- kindsテーブルの情報を"foreachを利用してセレクトボックスに表示させる --}}
                            <select id="category" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="kind_id">
                                @foreach($kinds as $kind)
                                    <option value="{{ $kind->id }}">{{ $kind->kind }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex my-6">

                        {{-- 体重 0.1kg単位--}}
                        <label class="block text-sm font-medium mr-2" for="weight">体重</label>
                        <div class="flex">
                            <input id="weight" class=" px-4 py-3 text-sm bg-white border rounded" type="number" name="weight" value="{{ old('weight') }}" step="0.1">
                            <span class="ml-2">kg</span>
                        </div>
                    

                    {{-- 誕生日　不明も選択できるようにする --}}
                        <label class="block text-sm font-medium ml-10 mr-2" for="birthday">誕生日</label>
                        <div class="flex">
                            <input id="birthday" class=" px-4 py-3 text-sm bg-white border rounded" type="date" name="birthday" value="{{ old('birthday') }}">
                        </div>
                        {{-- statusテーブルで公開設定 --}}
                        <label class="block text-sm font-medium ml-10 mr-2" for="birthday">公開設定</label>
                        <div class="flex">
                            <select id="status" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="status_id">
                                @foreach($statuses as $status)
                                    @if($status->id <= 2)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 紹介文 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="introduction">紹介文</label>
                        <textarea id="body" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="introduction" rows="5">{{ old('introduction') }}</textarea>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<script>

    // 画像プレビュー
    document.getElementById('image').addEventListener('change', e => {
        const previewImageNode = document.getElementById('previewImage')
        const fileReader = new FileReader()
        fileReader.onload = () => previewImageNode.src = fileReader.result
        if (e.target.files.length > 0) {
            fileReader.readAsDataURL(e.target.files[0])
        } else {
            previewImageNode.src = previewImageNode.dataset.noimage
        }
    })
</script>
@endsection
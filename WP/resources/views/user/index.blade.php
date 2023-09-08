@extends('user.home')
@section('title', 'HOME')
@section('content')


<section class="py-20 bg-blueGray-50">
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
<h2>動物保護団体更新情報</h2>
@endsection
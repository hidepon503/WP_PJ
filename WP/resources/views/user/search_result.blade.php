@extends('user.home')
@section('title', 'search')
@section('content')
<section class="py-20 bg-blueGray-50">
    <div class="container px-4 mx-auto">
        <h2>保護猫検索</h2>
        <form action="{{ route('search.result') }}" method='post'>
            @csrf
            <div class="flex mt-12 mb-6">
                <div class="flex items-center mr-20">
                    <label class="block mr-6 text-sm font-medium mb-2" for="image">エリア</label>
                    <select id="area" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="area_id">
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
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
        </form>
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
            {{ $cats->links() }}
        </div>
    </div>
</section>
<h2>動物保護団体更新情報</h2>
@endsection
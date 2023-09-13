@extends('user.home')
@section('title', 'search')
@section('content')


<section class="py-20 bg-blueGray-50">
    <div class="container px-4 mx-auto">
        <h2>保護猫検索</h2>
        <form action="{{ route('search.result') }}" method='get'>
            <div class=" mt-12 mb-6">
                <div class="flex items-center mr-20">
                    <label class="block mr-6 text-sm font-medium mb-2" for="image">性別</label>
                    @foreach($genders as $gender)
                    <label>
                        <input type="radio" name="gender_id" value="{{ $gender->id }}" {{ old('gender_id') == $gender->id ? 'checked' : '' }} required class="ml-12 mr-6">
                        {{ $gender->gender }}  <!-- 例えば、gendersテーブルがnameカラムを持っている場合 -->
                    </label>
                    @endforeach
                    <input type="radio" id="nonreserve" name="gender_id" value="" {{ !old('gender_id') ? 'checked' : '' }} required class="ml-12 mr-6"><label for="nonreserve">{{ '指定なし' }}</label>
                </div>
                
                {{-- 種類 --}}
                <div class="flex items-center p-2">
                    <label class="block text-sm font-medium  " for="category">種類　 :</label>
                    {{-- kindsテーブルの情報を"foreachを利用してセレクトボックスに表示させる --}}
                    <select id="category" class="appearance-none block h-8 pl-4 pr-8 ml-2 mb-2 text-sm bg-white border rounded" name="kind_id">
                        <option value="">指定なし</option>
                        @foreach($kinds as $kind)
                        <option value="{{ $kind->id }}" {{ old('kind_id') == $kind->id ? 'selected' : '' }}>{{ $kind->kind }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center">
                    <!-- 年齢の下限 -->
                    <label class="block text-sm font-medium mr-2" for="min_age">最小年齢:</label>
                    <input type="number" name="min_age" min="0" value="{{ old('min_age') }}" class="text-sm bg-white border h-8 rounded">
                    <!-- 年齢の上限 -->
                    <label class="block text-sm font-medium mr-2 ml-10" for="max_age">最大年齢:</label>
                    <input type="number" name="max_age" min="0" value="{{ old('max_age') }} " class="text-sm h-8 bg-white border rounded">
                    <button  class="inline-block h-8 px-4  ml-10 text-xs font-semibold leading-none bg-blue-500 hover:bg-blue-600 text-white rounded">
                        検索
                    </button>
                </div>
            </div>
            <div class="flex w-auto">
                <div class="flex items-center">
                    <label class="block text-sm font-medium mr-2" for="order">並べ替え:</label>
                    <select name="order" id="order" class="appearance-none block h-8 pl-4 pr-8  text-sm bg-white border rounded">
                        <option value="created_at_desc" {{ old('order') == 'created_at_desc' ? 'selected' : '' }}>登録順 (降順)</option>
                        <option value="created_at_asc" {{ old('order') == 'created_at_asc' ? 'selected' : '' }}>登録順 (昇順)</option>
                        <option value="age_desc" {{ old('order') == 'age_desc' ? 'selected' : '' }}>年齢順 (降順)</option>
                        <option value="age_asc" {{ old('order') == 'age_asc' ? 'selected' : '' }}>年齢順 (昇順)</option>
                    </select>
                    <button class="inline-block px-4 h-8 text-xs font-semibold leading-none bg-blue-500 hover:bg-blue-600 text-white rounded ml-3">
                        並べ替え
                    </button>
                </div>
            </div>
        </form>







        <div class="flex flex-wrap">
            @foreach($cats as $cat)
                <div class="catcontainer w-full md:w-1/4 py-5 md:px-5">
                    <div class=" px-2 bg-white shadow rounded h-56 py-6">
                        <div class="flex flex-col justify-center items-center  mb-4">
                            <!-- 仮定として、CatImageモデルと関連付けがされており、最初の画像を取得できるとします -->
                            <a href="{{ route('cat.show', $cat->id) }}" class="">
                                <img class="h-24 w-24 mb-2 rounded-full object-cover" src="{{ asset('storage/images/cats/' . $cat->image) }}" alt="{{ $cat->name }}">
                            </a>
                                <div class="">
                                    <p class="text-l text-center">{{ $cat->name }}</p>
                                    <!-- 仮定として、genderとkindの関係も設定されているとします -->
                                    <p class="text-blueGray-400 text-center text-xs">{{ $cat->kind->kind }}</p>
                                    <p class="text-xs text-center text-blueGray-400">{{ $cat->age }}歳  ({{ $cat->gender->gender }})</p>
                                    <!-- お気に入りボタン -->
                                    @livewire('favorite-component', ['catId' => $cat->id])
                                </div>
                            </div>
                            <p class="leading-loose text-blueGray-400 mb-5 whitespace-pre-line">
                                <!-- 何かのテキスト情報を表示したい場合、以下のようにすることができます -->
                                {{ $cat->description }} 
                            </p>
                        </div>
                </div>
            @endforeach
            {{ $cats->appends(['gender_id' => old('gender_id'), 'kind_id' => old('kind_id'), 'min_age' => old('min_age'), 'max_age' => old('max_age'), 'order' => old('order')])->links() }}
        </div>
    </div>
</section>
@endsection
@extends('user.home')
@section('title', 'Favorite')
@section('content')


<section class="py-20 bg-blueGray-50">
    <div class="container px-4 mx-auto">
        <h2>お気に入り一覧</h2>
        <form action="{{ route('favorites.index') }}" method='get'>
            <div class="flex w-auto">
                <div class="flex items-center">
                    <label class="block text-sm font-medium mr-2" for="order">並べ替え:</label>
                    <select name="order" id="order" class="appearance-none block h-8 pl-4 pr-8  text-sm bg-white border rounded">
                        <option value="favorite_created_asc" {{ old('order') == 'favorite_created_asc' ? 'selected' : '' }}>お気に入り登録日 (昇順)</option>
                        <option value="favorite_created_desc" {{ old('order') == 'favorite_created_desc' ? 'selected' : '' }}>お気に入り登録日 (降順)</option>
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
            @foreach($favorites as $cat)
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
            {{ $favorites->appends(['gender_id' => old('gender_id'), 'kind_id' => old('kind_id'), 'min_age' => old('min_age'), 'max_age' => old('max_age'), 'order' => old('order')])->links() }}
        </div>
    </div>
</section>
@endsection
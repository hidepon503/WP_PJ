@extends('user.home')
@section('title', 'HOME')
<style>
/* 追加 */


.blue-corner {
    position: relative;
}

.blue-corner::before {
    font-size: 12px;
    content: "交渉中";
    color: white;
    padding: 4px 2px;
    position: absolute;
    top: 0;
    right: 0;
    background: blue;
    z-index: 1;
}

.family-decided-text {
    padding: 2px 8px;
    border-radius: 5px;
}
</style>
@section('content')

@if(!$user_cats->isEmpty())  {{-- $matchingsにデータが存在する場合 --}}
<section class="section1">
    @foreach($matchings as $matching)
    <a href="{{ route('matching.show', ['cat' => $matching->cat->id, 'user' => auth() -> id()]) }}">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">My Pets</h2>
        <div class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
            <div class="flex items-center gap-x-4">
                <img class="rounded-full w-40 h-40" src="{{ asset('storage/images/cats/' .$matching->cat->image )}}" alt="$matching->cat->name">
                <div class="grow">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">
                        {{ $matching->cat->name }}
                    </h3>
                    <p class="text-xs uppercase text-gray-500">
                        {{ $matching->cat->admin->name  }}
                    </p>
                    <p class="mt-3 text-gray-500">
                        I am an ambitious workaholic, but apart from that, pretty simple person.
                    </p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
    <!-- End Col -->

</section>

@else {{-- $matchingsにデータが存在しない場合 --}}
<section class="section2 py-20 bg-blueGray-50">
    <div class="container px-4 mx-auto">
        <h2>新着登録猫一覧</h2>
        <div class="flex flex-wrap">
            @foreach($cats as $cat)
                <div class="catcontainer w-full md:w-1/4 py-5 md:px-5">
                    <div class=" px-2 bg-white shadow rounded h-56 py-6 {{ $cat->status_id == 4 ? 'blue-corner' : '' }}">
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
        </div>
    </div>
</section>
@endif
<h2>動物保護団体更新情報</h2>
@endsection
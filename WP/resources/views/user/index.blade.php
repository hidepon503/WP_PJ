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

@if(!$matchingRequests->isEmpty())  {{-- $matchingsにデータが存在する場合 --}}
    @include ('user.component.catlist',
    [
        'listTitle' => 'マッチング申請中',
        'requests' => $matchingRequests,
    ])
@endif

@if(!$matchings->isEmpty())  {{-- $matchingsにデータが存在する場合 --}}
    @include ('user.component.catlist',
    [
        'listTitle' => 'My Pets',
        'requests' => $matchings,
    ])
@endif

@if(!$lostchilds->isEmpty())  {{-- $lostchildsにデータが存在する場合 --}}
    @include ('user.component.catlist',
    [
        'listTitle' => '迷子中',
        'requests' => $lostchilds,
    ])
@endif

@if(!$deads->isEmpty())  {{-- $lostchildsにデータが存在する場合 --}}
    @include ('user.component.catlist', 
    [
        'listTitle' => '死亡',
        'requests' => $deads,
        ])
@endif




@if($matchings->isEmpty())  {{-- $matchingsにデータが存在する場合 --}}
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
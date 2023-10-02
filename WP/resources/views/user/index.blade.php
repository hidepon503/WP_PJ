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
                    <div class="catcontainer w-full md:w-1/4 py-3  md:px-3">
                    <!-- status_idに基づいてクラスを動的に追加 -->
                    <div class=" bg-white shadow rounded  py-6 {{ $cat->status_id == 4 ? 'blue-corner' : '' }}">
                        <div class="px-2 flex flex-col justify-center items-center ">
                            <!-- 画像、名前、性別、種類、お気に入りボタンなどの表示部分はそのまま保持 -->
                            <a href="{{ route('cat.show', $cat->id) }}" class="">
                                <img class="h-24 w-24 mb-2 rounded-full object-cover" src="{{ asset('storage/images/cats/' . $cat->image) }}" alt="{{ $cat->name }}">
                            </a>
                            <div class="" style="">
                                <p class="text-l mb-1 text-center" style="font-size:14px;">{{ $cat->name }}
                                    <span class="" style="font-size:8px;">
                                        {{ $cat->age }}歳  {{ $cat->gender->gender }}
                                    </span>
                                </p>
                                <p class="text-blueGray-400 text-center mb-2" style="font-size: 8px;">{{ $cat->kind->kind }} </p>
                                <div class="flex justify-end items-center" style="padding-right:-2px;">
                                    <span class="mr-2" style="font-size:8px;">
                                        {{ $cat->admin->prefecture }}
                                    </span>
                                    <span class="">
                                        @livewire('favorite-component', ['catId' => $cat->id])
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- status_idが3か4のときに"家族決定"のテキストを表示 -->

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
<h2>動物保護団体更新情報</h2>
@endsection
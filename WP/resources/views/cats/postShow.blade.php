@extends('layouts.admin')
@section('title', '投稿詳細ページ')
<style>
.carousel-inner .carousel-item img, .carousel-inner .carousel-item video {
    width: 100%;
    height: 400px;
    object-fit: cover; /* これは横長のデフォルトの画像やビデオのスタイルとして設定しています */
}

.carousel-inner .carousel-item img.vertical, .carousel-inner .carousel-item video.vertical {
    object-fit: contain !important; /* 縦長の画像やビデオにこのスタイルが適用されるようにします */
}
</style>

@section('content')

    <div class="px-6 bg-white shadow rounded h-full py-10">
{{-- @include('cats.component.catShow') --}}
<div class="flex pl-6 pt-12 items-center gap-x-4 ">
    <div class="w-40 h-40 rounded-full overflow-hidden">
        <img class="w-full h-full object-cover" src="{{ asset('storage/images/cats/' .$cat->image )}}" alt="$cat->name">
    </div>
    <div class="grow pl-6">
        <h3 class="font-medium text-gray-800 dark:text-gray-200">
            {{ $cat->name }}
            <span class="ml-2">{{ $cat->gender->gender }}</span>
            <span class="ml-2">{{ $age }}歳</span>
        </h3>
        <p class="text-xs mb-4 uppercase text-gray-500">
            契約状況：{{ $cat->status->name  }}
            <span class="ml-4">ユーザー：</span>
            @if(isset($userByCat[$cat->id]))
                <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                    <span>
                        ユーザー：{{ $userByCat[$cat->id]->name }}
                    </span>
                </span>
            @else
                <span>未定</span>
            @endif
        </p>
        <p>種類：{{ $cat->kind->kind }}</p>
        <p>生年月日：{{ $cat->birthday }}
            <span class="ml-4">体重：{{ $cat->weight }}kg</span>
        </p>
        <p class="mt-3 text-gray-500">
            {{ $cat->introduction }}
        </p>
    </div>
</div>
{{-- @include('cats.component.manu') --}}
{{-- メニューバー --}}
  <div class="text-gray-600 mt-4 px-8 body-font">
    <div class="container mx-auto text-align flex flex-wrap justify-center py-3 flex-col bg-gray-100 md:flex-row items-center rounded-full">
      <nav class=" md:ml-auto  md:mr-auto flex flex-wrap items-center text-base justify-center">
          <a href='{{ route('cat.show', $cat->id)  }}' class="hover:text-gray-900">
              <div class="w-30">ポスト一覧</div>
          </a>
          <a href='{{ route('cat.chat', [$cat->id , 'admin'=> $cat->admin->id, ]) }}' class="hover:text-gray-900">
              <div class="w-30 mx-24">ユーザー情報</div>
          </a>
          <a href='{{ route('edit.cats', $cat->id) }}' class="hover:text-gray-900">
              <div class="w-30">編集</div>
          </a>
      </nav>
    </div>
  </div>
{{-- @include('cats.component.createButton') --}}
{{-- <div class="container mx-auto mb-6">
    <a href="{{ route("postCat.create", ['cat' => $cat->id]) }}">
        <button class="mt-6 text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded py-4 w-full" type="submit">新規投稿</button>
    </a>
</div> --}}
{{-- @include('cats.component.postShow') --}}
<section class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-col px-5 py-24 justify-center items-center">
        
        <!-- Carousel -->
        <div id="mediaCarousel" class="carousel slide w-full h-auto" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($post_images as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="{{ $image->name }}">
                    </div>
                @endforeach
                @foreach($post_videos as $key => $video)
                    <div class="carousel-item {{ count($post_images) == 0 && $key == 0 ? 'active' : '' }}">
                        <video controls class="d-block w-100">
                            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                        </video>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#mediaCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#mediaCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="w-full md:w-2/3 flex flex-col mb-16 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{ $post->title }}</h1>
            <p class="mb-8 leading-relaxed">
                {{ $post->body }}
            </p>
        </div>
    </div>
</section>
@endsection
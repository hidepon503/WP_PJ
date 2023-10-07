@extends('user.home')
@section('title', 'CAT DATA')
@section('content')
<section>
    @include('user.component.show-component')
    @include('user.component.manu-component')
    <div class="px-4 py-6">
        {{-- @include('cats.component.postIndex') --}}
          <div class="flex flex-wrap -m-4">
    @foreach($posts as $post)
    <a class="w-1/3" href="{{ route('userPost.show',['cat' => $cat->id, 'post' => $post->id]) }}">
      <div class=" lg: sm: p-4">
        <div class="flex relative">
          @if($post->media_type == 'image' && $post->image)
          <img alt="gallery" class="absolute inset-0 w-full h-40 object-cover object-center" src="{{ asset('storage/' . $post->image->image_path) }}">
          @elseif($post->media_type == 'video' && $post->video)
          <video class="absolute inset-0 w-full h-40 object-cover object-center" controls>
            <source src="{{ asset('storage/app/public/' . $post->video->video_path) }}" type="video/mp4">
            </video>
            @endif
            <div class="px-8 py-10 relative z-10 w-full h-40 border-4 border-gray-200 bg-white opacity-0 hover:opacity-50">
              <h2 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $post->title }}</h2>
              <h1 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{ $post->body }}</h1>
            </div>
          </div>
        </div>
      </a>
    @endforeach
    </div>
    </div>
</section>
<section>
</section>



@endsection
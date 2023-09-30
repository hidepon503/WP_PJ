@extends('user.catShow')
@section('title', 'CATS DATA')
@section('catManu')
<div>

  <div class="container mx-auto mb-6">
        <a href="{{ route("post.create", ['cat' => $matching->cat_id, 'user' => auth() -> id()]) }}">
            <button class="mt-6 text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded py-4 w-full" type="submit">新規投稿</button>
        </a>
    </div>
</div>

  <div class="flex flex-wrap -m-4">
    @foreach($posts as $post)
      <div class=" lg:w-1/3 sm:w-1/2 p-4">
          <div class="flex relative">
              @if($post->media_type == 'image')
              <img alt="gallery" class="absolute inset-0 w-full h-40 object-cover object-center" src="{{ asset('storage/app/public/' . $post->media_path) }}">
              @elseif($post->media_type == 'video')
              <video class="absolute inset-0 w-full h-40 object-cover object-center" controls>
                  <source src="{{ asset('storage/app/public/' . $post->media_path) }}" type="video/mp4">
              </video>
              @endif
              <div class="px-8 py-10 relative z-10 w-full h-40 border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                  <h2 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $post->title }}</h2>
                  <h1 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{ $post->body }}</h1>
              </div>
          </div>
        </div>
    @endforeach
  </div>
@endsection
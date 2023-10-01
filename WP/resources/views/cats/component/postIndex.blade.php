  <div class="flex flex-wrap -m-4">
    @foreach($posts as $post)
    <a class="w-1/3" href="{{ route('post.show',['cat' => $posts->cat_id, 'post' => $posts->id]) }}">
      <div class=" lg: sm: p-4">
        <div class="flex relative">
          @if($posts->media_type == 'image')
          <img alt="gallery" class="absolute inset-0 w-full h-40 object-cover object-center" src="{{ asset('storage/' . $post->media_path) }}">
          @elseif($posts->media_type == 'video')
          <video class="absolute inset-0 w-full h-40 object-cover object-center" controls>
            <source src="{{ asset('storage/app/public/' . $post->media_path) }}" type="video/mp4">
            </video>
            @endif
            <div class="px-8 py-10 relative z-10 w-full h-40 border-4 border-gray-200 bg-white opacity-0 hover:opacity-50">
              <h2 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $posts->title }}</h2>
              <h1 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{ $posts->body }}</h1>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>
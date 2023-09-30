@extends('user.catShow')
@section('title', 'CAT POST')
@section('catManu')
<section class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-col px-5 py-24 justify-center items-center">
        
        <!-- Carousel -->
        <div id="mediaCarousel" class="carousel slide" data-ride="carousel">
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
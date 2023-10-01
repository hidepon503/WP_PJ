@extends('user.catShow')
@section('title', 'CAT POST')
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
@section('catManu')
@include('user.component.postShow')
@endsection

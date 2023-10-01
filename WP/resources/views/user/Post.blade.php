@extends('user.catShow')
@section('title', 'CAT POST')
@section('catManu')
  
@include('user.component.postStore')

<script>
// 修正中
    // 画像プレビュー
    document.getElementById('image').addEventListener('change', e => {
        const previewImageNode = document.getElementById('previewImage')
        const fileReader = new FileReader()
        fileReader.onload = () => previewImageNode.src = fileReader.result
        if (e.target.files.length > 0) {
            fileReader.readAsDataURL(e.target.files[0]);
        }else {
            previewImageNode.src = previewImageNode.dataset.noimage
        }
    })
</script>

@endsection
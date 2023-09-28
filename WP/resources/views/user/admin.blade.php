@extends('user.home')
@section('title', 'CAT DATA')
@section('content')
<section>
    @include('user.component.show-component')
    @include('user.component.manu-component')
    <div class="px-4 py-6">
        @include('user.component.admin-component')
    </div>
</section>
<section>
</section>



@endsection
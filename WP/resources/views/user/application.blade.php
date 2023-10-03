@extends('user.catShow')
@section('title', '各種申請')
@section('catManu')
<section class="text-gray-600 body-font">
  <div class="container px-5 py-2 mx-auto">
    <div class="flex flex-wrap w-full mb-6 flex-col items-center text-center">
      <h1 class="sm:text-3xl text-2xl font-medium title-font  text-gray-900">各種申請一覧ページ</h1>
    </div>
    <div class="flex flex-wrap -m-4">
      <div class="xl:w-1/3 md:w-1/2 p-4">
        @if($matching->request_id == 2)
            <!-- request_id が 2 でないときにリンクを表示 -->
            <a href='{{ route('matching.comeback', ['cat' => $matching->cat->id, 'user' => auth() -> id()])  }}'>
        @endif
        <div class="border border-gray-200 p-6 rounded-lg {{ $matching->request_id != 2 ? 'opacity-50 cursor-not-allowed' : '' }}">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">引取り申請</h2>
            <p class="leading-relaxed text-bas text-s">
                ねこの飼育困難に陥った際は、こちらから保護団体へ連絡しましょう。
                <br>
            </p>
        </div>
        @if($matching->request_id == 2)
            </a>
        @endif
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        @if($matching->request_id == 2)
          <!-- request_id が 2 でないときにリンクを表示 -->
          <a href='{{ route('matching.lostchild', ['cat' => $matching->cat->id, 'user' => auth() -> id()])  }}'>
        @endif
          <div class="border border-gray-200 p-6 rounded-lg {{ $matching->request_id != 2 ? 'opacity-50 cursor-not-allowed' : '' }}">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                <circle cx="6" cy="6" r="3"></circle>
                <circle cx="6" cy="18" r="3"></circle>
                <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
              </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">迷子申請</h2>
            <p class="leading-relaxed text-base">ねこの行方が分からないときは、こちらをより迷子申請をしてください。</p>
          </div>
        @if($matching->request_id == 2)
          </a>
        @endif
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <!-- request_id が 6 のときにリンクを表示 -->
        @if(in_array($matching->request_id, [6, 7]))
          <a href='{{ route('matching.found', ['cat' => $matching->cat->id, 'user' => auth() -> id()])  }}'>
        @endif
          <div class="border border-gray-200 p-6 rounded-lg {{ $matching->request_id != [6,7] ? 'opacity-50 cursor-not-allowed' : '' }}">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">迷子発見報告</h2>
            <p class="leading-relaxed text-base">迷子だったねこを見つけた時は、こちらからご報告をお願いします。</p>
          </div>
        @if(in_array($matching->request_id, [6, 7]))
          </a>
        @endif
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        @if($matching->request_id == 2)
            <!-- request_id が 2 でないときにリンクを表示 -->
          <a href='{{ route('matching.dead', ['cat' => $matching->cat->id, 'user' => auth() -> id()])  }}'>
        @endif
          <div class="border border-gray-200 p-6 rounded-lg {{ $matching->request_id != 2 ? 'opacity-50 cursor-not-allowed' : '' }}">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">看取り報告</h2>
            <p class="leading-relaxed text-base">ねこを最期まで看取った時は、こちらから保護団体へ報告をお願いします。</p>
          </div>
        @if($matching->request_id == 2)
          </a>
        @endif
      </div>

  </div>
</section>

@endsection
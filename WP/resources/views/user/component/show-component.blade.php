<div class="flex pl-6 pt-12 items-center gap-x-4">
  
    <div class="w-48 h-48 rounded-full overflow-hidden">
    <img class="object-cover w-full h-full" src="{{ asset('storage/images/cats/' .$cat->image )}}" alt="{{ $cat->name }}">
    </div>
    <div class="grow pl-6">
        <h3 class="font-medium text-gray-800 dark:text-gray-200">
            {{ $cat->name }}
            <span class="ml-2">{{ $cat->gender->gender }}</span>
            <span class="ml-2">{{ $cat->age }}歳</span>
        </h3>
        <p class="text-xs mb-4 uppercase text-gray-500">
            登録保護団体：{{ $cat->admin->name }}
        </p>
        <p>種類：{{ $cat->kind->kind }}</p>
        <p>生年月日：{{ $cat->birthday }}
            <span class="ml-4">体重：{{ $cat->weight }}kg</span>
        </p>
        <p class="mt-3 text-gray-500">
            {{ $cat->introduction }}
        </p>
        <div class="flex  p-4">
            @php
                $existingMatching = \App\Models\Matching::where('user_id', auth()->id())->where('cat_id', $cat->id)->first();
            @endphp
            @if($cat->status_id == 2)
                @if (!$existingMatching)
                <form action="{{ route('match.store', $cat->id) }}" method="post">
                    @csrf
                    <button class="inline-block mx-auto px-8 h-8 text-xs font-semibold leading-none bg-blue-500 hover:bg-blue-600 text-white rounded ml-3" type="submit">マッチング申請</button>
                </form>
                @else
                
                <p>マッチング申請済</p>
                @endif
            @else
                <div class="inline-block flex items-center justify-center mx-auto px-8 h-8  text-xs font-semibold leading-none bg-white text-blue-600 border-blue-600 rounded ml-3" type="submit">交渉中
                </div>
            @endif
        </div>
    </div>
</div>
<div class="flex pl-6 pt-12 items-center gap-x-4 ">
    <div class="w-40 h-40 rounded-full overflow-hidden">
        <img class="w-full h-full object-cover" src="{{ asset('storage/images/cats/' .$matching->cat->image )}}" alt="$matching->cat->name">
    </div>
    <div class="grow pl-6">
        <h3 class="font-medium text-gray-800 dark:text-gray-200">
            {{ $matching->cat->name }}
            <span class="ml-2">{{ $matching->cat->gender->gender }}</span>
            <span class="ml-2">{{ $age }}歳</span>
        </h3>
        <p class="text-xs mb-4 uppercase text-gray-500">
            登録保護団体：{{ $matching->cat->admin->name  }}
            <span class="ml-4">契約状況：{{ $matching->request->answer }}</span>
        </p>
        <p>種類：{{ $matching->cat->kind->kind }}</p>
        <p>生年月日：{{ $matching->cat->birthday }}
            <span class="ml-4">体重：{{ $matching->cat->weight }}kg</span>
        </p>
        <p class="mt-3 text-gray-500">
            {{ $matching->cat->introduction }}
        </p>
    </div>
</div>
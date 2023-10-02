    <section class="section1">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $listTitle }}</h2>
        @foreach($requests as $request)
        <a href="{{ route('matching.show', ['cat' => $request->cat->id]) }}">
            <div class="flex flex-col rounded-lg p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
                <div class="flex items-center gap-x-4">
                    <div class="w-40 h-40 rounded-full overflow-hidden">
                        <img class="w-full h-full object-cover" src="{{ asset('storage/images/cats/' .$request->cat->image )}}" alt="$matching->cat->name">
                    </div>
                    <div class="grow">
                        <h3 class="font-medium text-gray-800 dark:text-gray-200">
                            {{ $request->cat->name }}
                        </h3>
                        <p class="text-xs uppercase text-gray-500">
                            {{ $request->cat->admin->name  }}
                        </p>
                        <p class="mt-3 text-gray-500">
                            {{ $request->cat->introduction }}
                        </p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        <!-- End Col -->
    </section>
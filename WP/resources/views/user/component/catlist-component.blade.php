    <section class="section1">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $listTitle }}</h2>
        @foreach($matchings as $matching)
        <a href="{{ route('matching.show', ['cat' => $matching->cat->id, 'user' => auth() -> id()]) }}">
            <div class="flex flex-col rounded-lg p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
                <div class="flex items-center gap-x-4">
                    <img class="rounded-full w-40 h-40" src="{{ asset('storage/images/cats/' .$matching->cat->image )}}" alt="$matching->cat->name">
                    <div class="grow">
                        <h3 class="font-medium text-gray-800 dark:text-gray-200">
                            {{ $matching->cat->name }}
                        </h3>
                        <p class="text-xs uppercase text-gray-500">
                            {{ $matching->cat->admin->name  }}
                        </p>
                        <p class="mt-3 text-gray-500">
                            I am an ambitious workaholic, but apart from that, pretty simple person.
                        </p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        <!-- End Col -->
    </section>
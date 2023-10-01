@if ($paginator->hasPages())
    <div class="inline-flex gap-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button type="button" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800" disabled>
                <svg ...></svg> 
                Prev
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="...">
                <svg ...></svg>
                Prev
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="...">
                Next
                <svg ...></svg>
            </a>
        @else
            <button class="..." disabled>
                Next
                <svg ...></svg>
            </button>
        @endif
    </div>
@endif

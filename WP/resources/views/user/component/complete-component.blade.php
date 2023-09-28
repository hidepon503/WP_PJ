
<section>
  <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 md:px-12 lg:px-24 lg:py-24">
    <div class="flex flex-col w-full mb-12 text-center">
      <div class="inline-flex items-center justify-center flex-shrink-0 w-20 h-20 mx-auto mb-5 text-blue-600 rounded-full bg-gray-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 icon icon-tabler icon-tabler-aperture" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <circle cx="12" cy="12" r="9"></circle>
          <line x1="3.6" y1="15" x2="14.15" y2="15"></line>
          <line x1="3.6" y1="15" x2="14.15" y2="15" transform="rotate(72 12 12)"></line>
          <line x1="3.6" y1="15" x2="14.15" y2="15" transform="rotate(144 12 12)"></line>
          <line x1="3.6" y1="15" x2="14.15" y2="15" transform="rotate(216 12 12)"></line>
          <line x1="3.6" y1="15" x2="14.15" y2="15" transform="rotate(288 12 12)"></line>
        </svg>
      </div>
      <h1 class="max-w-5xl text-2xl font-bold leading-none tracking-tighter text-neutral-600 md:text-5xl lg:text-6xl lg:max-w-7xl">{{ $applicationTitle }}
      </h1>
      <p class="max-w-xl mx-auto mt-8 text-base leading-relaxed text-center text-gray-500">{{$message }}</p>
      <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-center text-gray-500">
        登録団体「{{ $matching->cat->admin->name }}」からのご連絡をお待ちください。
      </p>
    </div>
  </div>
</section>




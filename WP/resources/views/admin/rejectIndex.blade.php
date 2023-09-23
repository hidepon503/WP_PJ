@extends('layouts.admin')

@section('title', 'マッチング拒否一覧') 

@section('content')

<section>
  <!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                マッチング拒否一覧
              </h2>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800" href="#">
                  View all
                </a>

                <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" href="#">
                  <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M2.63452 7.50001L13.6345 7.5M8.13452 13V2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  Add user
                </a>
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-slate-800">
              <tr>
                <th scope="col" class="w-10 px-6 py-3 text-left">
                  <label for="hs-at-with-checkboxes-main" class="flex">
                    <input type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-at-with-checkboxes-main">
                    <span class="sr-only">Checkbox</span>
                  </label>
                </th>

                <th scope="col" class="w-60 mr-6 pl-6 lg:pl-3 xl:pl-0 pr-6 py-3 text-left">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                      Cat
                    </span>
                  </div>
                </th>

                <th scope="col" class="w-60 px-6 py-3 text-left">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                      User
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-left">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                      Status
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-left">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                      申請日
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-left">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                      受理
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-right">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                      拒否
                    </span>
                  </div>
                </th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              {{-- ＠foreachを活用してmatchingsテーブルに登録のあった、レコードを一覧表示させる。catsテーブルにはAdmin_idが外部キー接続しており、Auth checkして操作するadminとid情報を持つレコードのみ表示させたい --}}
@foreach ($matchings as $matching)
    <tr>
        <td class="pl-6 py-3 text-left whitespace-nowrap">
            <label for="checkbox-{{ $matching->id }}" class="flex">
                <input type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="checkbox-{{ $matching->id }}">
                <span class="sr-only">Checkbox for {{ $matching->user->name }}</span>
            </label>
        </td>

        <td class="h-px w-px whitespace-nowrap">
            <div class="pl-6 lg:pl-3 xl:pl-0 pr-6 py-3">
                <div class="flex items-center gap-x-3">
                    <img class="inline-block w-32 rounded-full" src="{{  asset('storage/images/cats/' .$matching->cat->image )}}" alt="{{ $matching->cat->name }}">
                    <div class="grow">
                        <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $matching->cat->name }}</span>
                        <span class="block text-sm text-gray-500">
                          {{-- 後日猫の詳細ページに飛ぶボタンを設置したい --}}
                        </span>
                    </div>
                </div>
            </div>
        </td>

        <td class="h-px w-72 whitespace-nowrap">
          <div class="flex items-center gap-x-3">
            <img class="inline-block w-32 rounded-full" src="{{ asset('storage/images/users/' . $matching->user->image) }}" alt="{{ $matching->user->name }}">
            <div class="px-6 py-3">
              <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $matching->user->name }}</span>
              <span class="block text-sm text-gray-500">{{ $matching->user->email }}</span>
            </div>
          </div>
        </td>

        <td class="h-px w-px whitespace-nowrap">
            <div class="px-6 py-3">
                <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $matching->request->answer }}</span>
            </div>
        </td>

        <td class="h-px w-px whitespace-nowrap">
            <div class="px-6 py-3">
                <span class="text-sm text-gray-500">{{ $matching->created_at->format('Y m d, H:i') }}</span>
            </div>
        </td>

        <td class="h-px w-px whitespace-nowrap">
          <form action="{{ route('match.approve', $matching->id) }}" method="post">
              @csrf
              <button class="inline-block px-4 h-8 text-xs font-semibold leading-none bg-blue-500 hover:bg-blue-600 text-white rounded ml-3" type="submit">受理</button>
          </form>
        </td>

        <td class="h-px w-px whitespace-nowrap">
          <form action="{{ route('match.reject', $matching->id) }}" method="post">
              @csrf
              <button class="inline-block px-4 h-8 text-xs font-semibold leading-none bg-red-500 hover:bg-red-600 text-white rounded ml-3" type="submit">拒否</button>
          </form>
        </td>
    </tr>
@endforeach
              
              
            </tbody>
          </table>
          <!-- End Table -->

          <!-- Footer -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold text-gray-800 dark:text-gray-200">6</span> results
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                  <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                  </svg>
                  Prev
                </button>

                <button type="button" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                  Next
                  <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<!-- End Table Section -->
</section>
@endsection
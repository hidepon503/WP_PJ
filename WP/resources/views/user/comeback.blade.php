@extends('user.catShow')
@section('title', '各種申請')
@section('catManu')
<section class="text-gray-600 body-font">
  <div class="container px-5 py-2 mx-auto">
    <div class="flex flex-wrap w-full mb-6 flex-col items-center text-center">
      <h1 class="sm:text-3xl text-2xl font-medium title-font  text-gray-900">各種申請一覧ページ</h1>
    </div>
  </div>
      <div class="flex items-end justify-center  pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
          </div>             
          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">引取り申請</h3>
                  <div class="mt-2">
                      <p class="text-sm text-gray-500">
                          この操作は取り消せません。本当に申請してよろしいでしょうか？
                      </p>
                  </div>
                  <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="post" action="{{ route('comeback.request', ['cat' => $matching->cat->id, 'user' => auth() -> id()])   }}">
                      @csrf
                      <input type="hidden" name="request_id" value="4">
                      <button  type="submit" class="mt-3 ml-6 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-base font-medium  text-white">
                        YES
                      </button>
                    </form>
                    
                    <a href="{{ url()->previous() }}">
                      <button class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                        NO
                      </button>
                    </a>
                  </div>
              </div>
              
          </div>
      </div>

@endsection



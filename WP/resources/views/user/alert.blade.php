@if(session()->has('message'))
    <!-- ▼▼▼▼登録完了メッセージ(全ページで共通)▼▼▼▼　-->
        <div class="mb-4 text-right">
            <div
                class="pl-6 pr-16 py-4 bg-white border-l-4 border-blue-500 shadow-md rounded-r-lg inline-block ml-auto">
                <div class="flex items-center">
                <span class="inline-block mr-2">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM14.2 8.3L9.4 13.1C9 13.5 8.4 13.5 8 13.1L5.8 10.9C5.4 10.5 5.4 9.9 5.8 9.5C6.2 9.1 6.8 9.1 7.2 9.5L8.7 11L12.8 6.9C13.2 6.5 13.8 6.5 14.2 6.9C14.6 7.3 14.6 7.9 14.2 8.3Z"
                        fill="#17BB84"></path>
                  </svg>
                </span>
                    <p class="text-blue-800 font-medium">{{ session('message') }}</p>
                </div>
            </div>
        </div>
        <!-- ▲▲▲▲登録完了メッセージ▲▲▲▲　-->
@endif
@if(session()->has('success'))
    <!-- ▼▼▼▼登録完了メッセージ(全ページで共通)▼▼▼▼　-->
        <div class="mb-4 text-right">
            <div
                class="pl-6 pr-16 py-4 bg-white border-l-4 border-green-500 shadow-md rounded-r-lg inline-block ml-auto">
                <div class="flex items-center">
                <span class="inline-block mr-2">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM14.2 8.3L9.4 13.1C9 13.5 8.4 13.5 8 13.1L5.8 10.9C5.4 10.5 5.4 9.9 5.8 9.5C6.2 9.1 6.8 9.1 7.2 9.5L8.7 11L12.8 6.9C13.2 6.5 13.8 6.5 14.2 6.9C14.6 7.3 14.6 7.9 14.2 8.3Z"
                        fill="#17BB84"></path>
                  </svg>
                </span>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        <!-- ▲▲▲▲登録完了メッセージ▲▲▲▲　-->
@endif
@if(session()->has('error'))
    <!-- ▼▼▼▼登録完了メッセージ(全ページで共通)▼▼▼▼　-->
        <div class="mb-4 text-right">
            <div
                class="pl-6 pr-16 py-4 bg-white border-l-4 border-red-500 shadow-md rounded-r-lg inline-block ml-auto">
                <div class="flex items-center">
                <span class="inline-block mr-2">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM14.2 8.3L9.4 13.1C9 13.5 8.4 13.5 8 13.1L5.8 10.9C5.4 10.5 5.4 9.9 5.8 9.5C6.2 9.1 6.8 9.1 7.2 9.5L8.7 11L12.8 6.9C13.2 6.5 13.8 6.5 14.2 6.9C14.6 7.3 14.6 7.9 14.2 8.3Z"
                        fill="#17BB84"></path>
                  </svg>
                </span>
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        <!-- ▲▲▲▲登録完了メッセージ▲▲▲▲　-->
@endif
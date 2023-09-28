{{-- メニューバー --}}
                    <div class="text-gray-600 mt-4 px-8 body-font">
                      <div class="container mx-auto text-align flex flex-wrap justify-center py-5 flex-col bg-gray-100 md:flex-row items-center rounded-full">
                        <nav class=" md:ml-auto  md:mr-auto flex flex-wrap items-center text-base justify-center">
                            <a href='{{ route('cat.show', $cat->id)  }}' class="hover:text-gray-900">
                                <div class="w-30">ポスト一覧</div>
                            </a>
                            <a href='{{ route('cat.chat', [$cat->id , 'admin'=> $cat->admin->id, ]) }}' class="hover:text-gray-900">
                                <div class="w-30 mx-24">チャット</div>
                            </a>
                            <a href='{{ route('cat.admin', [$cat->id, 'admin'=> $cat->admin->id,]) }}' class="hover:text-gray-900">
                                <div class="w-30">登録団体</div>
                            </a>
                        </nav>
                      </div>
                    </div>
                  
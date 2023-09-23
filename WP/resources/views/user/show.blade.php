@extends('user.home')
@section('title', 'CAT DATA')
@section('content')
<section>
     
        <div class="mb-4 py-4 flex">
            <div class="flex flex-col items-center px-6">
                <img class="h-64 w-80 mb-6 object-cover" src="{{ asset('storage/images/cats/' . $cat->image) }}" alt="{{ $cat->name }}">
                <form action="{{ route('match.store', $cat->id) }}" method="post">
                    @csrf
                    <button class="inline-block px-4 h-8 text-xs font-semibold leading-none bg-blue-500 hover:bg-blue-600 text-white rounded ml-3" type="submit">マッチング申請</button>
                </form>
                {{-- Alert表示をインポートする --}}
                <div class="my-6">
                    @include('user.alert')
                </div>
            </div>
            
            {{-- CSSグリッドを利用した２カラムレイアウトで、猫の詳細を表示 --}}
            
            <div class="grid grid-cols-4 gap-x-16 gap-y-8 text-2xl">
                <label for="cat-name" class="grid-item col-span-1 font-bold">名前</label>
                <div id="cat-name" class="grid-item col-span-3">{{ $cat->name }}</div>
                <label for="cat-admin-name" class="grid-item col-span-1 font-bold">登録団体名</label>
                <div id="cat-admin-name" class="grid-item col-span-3">{{ $cat->admin->name }}</div>
                <label for="cat-gender" class="grid-item col-span-1 font-bold">性別</label>
                <div id="cat-gender" class="grid-item col-span-3">{{ $cat->gender->gender }}</div>

                <label for="cat-kind" class="grid-item col-span-1 font-bold">種類</label>
                <div id="cat-kind" class="grid-item col-span-3">{{ $cat->kind->kind }}</div>

                <label for="cat-birthday" class="grid-item col-span-1 font-bold">生年月日</label>
                <div id="cat-birthday" class="grid-item col-span-3">{{ $cat->birthday }}</div>

                <label for="cat-age" class="grid-item col-span-1 font-bold">年齢</label>
                <div id="cat-age" class="grid-item col-span-3">{{ $cat->age }}歳</div>

                <label for="cat-weight" class="grid-item col-span-1 font-bold">体重</label>
                <div id="cat-weight" class="grid-item col-span-3">{{ $cat->weight }}kg</div>

                <label for="status" class=" col-span-1 font-bold">公開設定</label>
                <div id="status" class=" col-span-3">{{ $cat->weight }}kg</div>

                

                <label for="cat-introduction" class="grid-item col-span-1 font-bold">紹介文</label>
                <div id="cat-introduction" class="grid-item col-span-3">{{ $cat->introduction }}</div>

                
            </div>
        </div>
</section>
<section>
    
        <!-- ここにもし管理者の写真やアイコンがある場合は、imgタグを使用して表示させることができます -->

        <div class="pl-16">
            {{-- CSSグリッドを利用した２カラムレイアウトで、管理者の詳細を表示 --}}
            <div class="grid grid-cols-4 gap-x-16 gap-y-8 text-2xl">
                <label for="admin-name" class="grid-item col-span-1 font-bold">動物保護団体名</label>
                <div id="admin-name" class="grid-item col-span-3">{{ $admin->name }}</div>

                <label for="admin-email" class="grid-item col-span-1 font-bold">メールアドレス</label>
                <div id="admin-email" class="grid-item col-span-3">{{ $admin->email }}</div>

                <!-- 注意: パスワードはセキュリティ上の理由から表示するべきではありません -->

                <label for="admin-tel" class="grid-item col-span-1 font-bold">電話番号</label>
                <div id="admin-tel" class="grid-item col-span-3">{{ $admin->tel }}</div>

                <label for="admin-postcode" class="grid-item col-span-1 font-bold">郵便番号</label>
                <div id="admin-postcode" class="grid-item col-span-3">{{ $admin->postcode }}</div>

                <label for="admin-address" class="grid-item col-span-1 font-bold">住所</label>
                <div id="admin-address" class="grid-item col-span-3">{{ $admin->address }}</div>

                <label for="admin-ceo_id" class="grid-item col-span-1 font-bold">代表者ID</label>
                <div id="admin-ceo_id" class="grid-item col-span-3">{{ $admin->ceo_id }}</div>

                <label for="admin-introduction" class="grid-item col-span-1 font-bold">紹介文</label>
                <div id="admin-introduction" class="grid-item col-span-3">{{ $admin->introduction }}</div>
            </div>
        </div>
    </div>
</div>
</section>


@endsection
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="/css/tailwind/tailwind.min.css">
    {{-- モーダル用 --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/9-6-1.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
    <script src="/js/main.js"></script>
    @livewireStyles

</head>
<body class="antialiased bg-body text-body font-body">

<!-- ▼▼▼▼共通ヘッダー▼▼▼▼　-->
<header>
    <div class="container px-4 mx-auto">
        <nav class="flex items-center justify-between py-6">
            <a class="text-3xl font-semibold leading-none" href="/"><img src="/images/withpets/WithPetsLogo.png" alt="With Pets" class="h-20"></a>
            {{-- <ul class="hidden lg:flex ml-12 mr-auto space-x-12">
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#">With Petsとは</a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#">保護猫一覧</a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="/blogs">サービス</a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#">料金</a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="/contact">保護団体の皆様へ</a></li>
            </ul> --}}
            <div>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button  class="inline-block px-4 py-3 text-xs font-semibold leading-none bg-blue-500 hover:bg-blue-600 text-white rounded">
                    ログアウト
                    </button>
                </form>
            </div>
        </nav>
    </div>
</header>
<!-- ▲▲▲▲共通ヘッダー▲▲▲▲　-->

<main class="container flex px-4 mx-auto">
    <!-- ▼▼▼▼メニュー▼▼▼▼　-->
    <div class="menu-container w-1/4 ">
        @include('user.component.user-menu')
    </div>

    
    <!-- ▼▼▼▼ページ毎の個別内容▼▼▼▼　-->
    <div class="content w-3/4 px-6">
        @yield('content')
    </div>





</main>
<!-- ▲▲▲▲ページ毎の個別内容▲▲▲▲　-->

<!-- ▼▼▼▼共通フッター▼▼▼▼　-->
<footer class="bg-black">
    <div class="px-4 container mx-auto p-10 flex justify-between">
        <div class="text-white text-left">
            <h2 class="text-xl font-semibold">WithPets</h2>
            <p>〒123-4567</p>
            <p>東京都墨田区押上1-2-3 Illuminateビル9F</p>
        </div>

        {{-- <ul class="text-white text-left hidden md:flex flex-wrap flex-col h-12 md:w-128">
            <li class="ml-6"><a href="/" class="hover:underline">ホーム</a></li>
            <li class="ml-6"><a href="#" class="hover:underline">設備</a></li>
            <li class="ml-6"><a href="#" class="hover:underline">ねこちゃんたち</a></li>
            <li class="ml-6"><a href="/blogs" class="hover:underline">ブログ</a></li>
            <li class="ml-6"><a href="/#access" class="hover:underline">アクセス</a></li>
            <li class="ml-6"><a href="#" class="hover:underline">よくあるご質問</a></li>
            <li class="ml-6"><a href="/contact" class="hover:underline">お問い合わせ</a></li>
            <li class="ml-6"><a href="#" class="hover:underline">プライバシーポリシー</a></li>
        </ul> --}}
    </div>
</footer>
<!-- ▲▲▲▲共通フッター▲▲▲▲　-->

@livewireScripts
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<!--自作のJS-->
<script src="{{ asset('js/9-6-1.js') }}"></script>
</body>
</html>


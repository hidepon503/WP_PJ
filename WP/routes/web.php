<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return view('index');
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('user.index');
});

//Userの breeze のログインまわりのルーティング
//ログイン処理後HomeControllerのindex処理をさせる
//以下の記述は特定のルートに対して、ミドルウェアを適用する方法
// Route::get('/home', [HomeController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('home');

// 下記のようにグループ化することで、グループ内のルートに対して、ミドルウェアを適用することができる
Route::middleware(['auth', 'verified'])->group(function () {
    // ログイン後のホーム画面
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // 猫の詳細画面
    Route::get('/cat/{cat}', [HomeController::class, 'show'])->name('cat.show');
    // 猫の検索画面
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    // 猫の検索結果画面
    Route::get('/search/result', [HomeController::class, 'searchResult'])->name('search.result');
    // 猫のお気に入り登録
    Route::post('/favorite/toggle/{catId}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
});


// アカウント管理画面
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// ログインまわりのルーティングここまで

// お問い合わせフォーム
// ①お問い合わせフォームの表示
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// ②お問い合わせフォームの送信
Route::post('/contact', [ContactController::class, 'sendMail']);
// ③お問い合わせフォームの送信完了
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');
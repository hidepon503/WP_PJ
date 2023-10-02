<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\UserPostController;

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
    // 猫の詳細画面のチャットページの表示
    Route::get('/cat/{cat}/chat', [HomeController::class, 'showChat'])->name('cat.chat');
    // 猫の詳細画面の登録団体紹介ページの表示
    Route::get('/cat/{cat}/admin', [HomeController::class, 'showAdmin'])->name('cat.admin');
    // 猫の検索画面
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    // 猫の検索結果画面
    Route::get('/search/result', [HomeController::class, 'searchResult'])->name('search.result');
    // 猫のお気に入り登録
    Route::post('/favorite/toggle/{catId}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
    // 猫のお気に入り一覧
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    //迷子猫一覧表示
    Route::get('/lostchild', [HomeController::class, 'lostchild'])->name('lostchild.search'); 
    //迷子絞り込み検索
    Route::get('/lostchild/search', [HomeController::class, 'lostchildSearch'])->name('lostchild.searchResult');
    //迷子猫詳細表示
    Route::get('/lostchild/{cat}', [HomeController::class, 'lostchildShow'])->name('lostchild.show');
    
    // 猫のマッチング申請
    Route::post('/cats/{cat}/match', [MatchingController::class, 'store'])->name('match.store');
//未実装ここから
    // 猫のマッチング申請キャンセル
    Route::delete('/cats/{cat}/match', [MatchingController::class, 'destroy'])->name('match.destroy');
// 未実装ここまで

    // マッチングした猫の詳細表示
    Route::get('/matching/{cat}', [MatchingController::class, 'show'])->name('matching.show');

    // マッチングした猫のPOST投稿ページ表示
    Route::get('/matching/{cat}/post',[UserPostController::class, 'create'])->name('userPost.create');

    // マッチングした猫のPOST投稿送信
    Route::post('/matching/{cat}/post',[UserPostController::class, 'store'])->name('userPost.store');
    // マッチングした猫のPOST内容表示
    Route::get('/matching/{cat}/post/{post}',[UserPostController::class, 'show'])->name('userPost.show');
    // マッチングした猫のPOST編集ページ表示
    Route::get('/matching/{cat}/post/{post}/edit',[UserPostController::class, 'edit'])->name('post.edit');
    // マッチングした猫のPOST編集送信
    Route::patch('/matching/{cat}/post/{post}',[UserPostController::class, 'update'])->name('post.update');
    // マッチングした猫のPOST削除
    Route::delete('/matching/{cat}/post/{post}',[UserPostController::class, 'destroy'])->name('post.destroy');

    




    // マッチングした猫の各種申請ページ表示
    Route::get('/matching/{cat}/{user}/application',[MatchingController::class, 'application'])->name('application');
    // マッチングした猫の引取り申請確認ページの表示
    Route::get('/matching/{cat}/{user}/application/comeback',[MatchingController::class, 'comeback'])->name('matching.comeback');
    //引取り申請送信
    Route::post('/matching/{cat}/{user}/application/comeback',[MatchingController::class, 'comebackRequest'])->name('comeback.request');

    // 猫の迷子申請確認ページの表示
    Route::get('/matching/{cat}/{user}/application/lostchild',[MatchingController::class, 'lostchild'])->name('matching.lostchild');
    //迷子申請送信
    Route::post('/matching/{cat}/{user}/application/lostchild',[MatchingController::class, 'lostchildRequest'])->name('lostchild.request');
    // 猫の発見報告確認ページの表示
    Route::get('/matching/{cat}/{user}/application/found',[MatchingController::class, 'found'])->name('matching.found');
    //発見報告送信
    Route::post('/matching/{cat}/{user}/application/found',[MatchingController::class, 'foundRequest'])->name('found.request');

    //猫の看取り報告確認ページの表示
    Route::get('/matching/{cat}/{user}/application/dead',[MatchingController::class, 'dead'])->name('matching.dead');
    //看取り報告送信
    Route::post('/matching/{cat}/{user}/application/dead',[MatchingController::class, 'deadRequest'])->name('dead.request');

    // マッチングした猫とのチャット画面表示
    
    // マッチングした猫との診察履歴ページ表示



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
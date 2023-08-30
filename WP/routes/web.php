<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
// use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerAuthController;
use App\Http\Controllers\Government\GovernmentController;
use App\Http\Controllers\Government\GovernmentAuthController;



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
Route::get('/dashboard', function () {
    return view('user.index');
})->middleware(['auth', 'verified'])->name('dashboard');


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


// adminログインまわりのルーティング
Route::prefix('/admin')
    ->name('admin.')
    ->group(function () {
        // adminアカウント登録画面表示
        Route::get('/create',[AdminController::class, 'create'])->name('create');
        // adminアカウント登録処理
        Route::post('/store',[AdminController::class, 'store'])->name('store');
        // ログイン画面の表示
        Route::get('/login',[AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
        // ログイン処理
        Route::post('/login',[AuthController::class, 'login'])->name('login');
        // ログイン時のみアクセス可能なルート
        Route::middleware('auth:admin')->group(function(){
            // 管理画面トップ
            Route::get('/',[AdminController::class, 'index'])->name('index');
            // ログアウト処理
            Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
        });
    });

// managerルーティング
Route::prefix('/manager')
    ->name('manager.')
    ->group(function () {
        // アカウント登録画面表示
        Route::get('/create',[ManagerController::class, 'create'])->name('create');
        // アカウント登録処理
        Route::post('/store',[ManagerController::class, 'store'])->name('store');
        // ログイン画面の表示
        Route::get('/login',[ManagerAuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
        // ログイン処理
        Route::post('/login',[ManagerAuthController::class, 'login'])->name('login');
        // ログイン時のみアクセス可能なルート
        Route::middleware('auth:manager')->group(function(){
            // 管理画面トップ
            Route::get('/',[ManagerController::class, 'index'])->name('index');
            // ログアウト処理
            Route::post('/logout',[ManagerAuthController::class, 'logout'])->name('logout');
        });
    });

// governmentルーティング
Route::prefix('/government')
    ->name('government.')
    ->group(function () {
        // アカウント登録画面表示
        Route::get('/create',[GovernmentController::class, 'create'])->name('create');
        // アカウント登録処理
        Route::post('/store',[GovernmentController::class, 'store'])->name('store');
        // ログイン画面の表示
        Route::get('/login',[GovernmentAuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
        // ログイン処理
        Route::post('/login',[GovernmentAuthController::class, 'login'])->name('login');
        // ログイン時のみアクセス可能なルート
        Route::middleware('auth:government')->group(function(){
            // 管理画面トップ
            Route::get('/',[GovernmentController::class, 'index'])->name('index');
            // ログアウト処理
            Route::post('/logout',[GovernmentAuthController::class, 'logout'])->name('logout');
        });
    });
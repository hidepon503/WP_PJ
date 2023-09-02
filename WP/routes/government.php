<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Government\GovernmentController;
use App\Http\Controllers\Government\GovernmentAuthController;


// governmentアカウント登録画面表示
// アカウント登録画面表示
Route::get('/create',[GovernmentController::class, 'create'])->name('government.create');
// アカウント登録処理
Route::post('/store',[GovernmentController::class, 'store'])->name('government.store');
// ログイン画面の表示
Route::get('/login',[GovernmentAuthController::class, 'showLoginForm'])->middleware('guest');
// ログイン処理
Route::post('/login',[GovernmentAuthController::class, 'login'])->name('government.login');
// ログイン時のみアクセス可能なルート
Route::middleware('auth:government')->group(function(){
    // 管理画面トップ
    Route::get('/',[GovernmentController::class, 'index'])->name('government.index');
    // ログアウト処理
    Route::post('/logout',[GovernmentAuthController::class, 'logout'])->name('government.logout');
});

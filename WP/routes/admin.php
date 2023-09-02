<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;


// adminアカウント登録画面表示
Route::get('/create',[AdminController::class, 'create'])->name('admin.create');
// adminアカウント登録処理
Route::post('/store',[AdminController::class, 'store'])->name('admin.store');
// ログイン画面の表示
Route::get('/login',[AuthController::class, 'showLoginForm'])->middleware('guest');
// ログイン処理
Route::post('/login',[AuthController::class, 'login'])->name('admin.login');
// ログイン時のみアクセス可能なルート
Route::middleware('auth:admin')->group(function(){
    // 管理画面トップ
    Route::get('/',[AdminController::class, 'index'])->name('admin.index');
    // ログアウト処理
    Route::post('/logout',[AuthController::class, 'logout'])->name('admin.logout');
});
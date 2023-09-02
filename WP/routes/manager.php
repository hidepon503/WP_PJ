<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerAuthController;


// アカウント登録画面表示
Route::get('/create',[ManagerController::class, 'create'])->name('manager.create');
// アカウント登録処理
Route::post('/store',[ManagerController::class, 'store'])->name('manager.store');
// ログイン画面の表示
Route::get('/login',[ManagerAuthController::class, 'showLoginForm'])->middleware('guest');
// ログイン処理
Route::post('/login',[ManagerAuthController::class, 'login'])->name('manager.login');
// ログイン時のみアクセス可能なルート
Route::middleware('auth:manager')->group(function(){
    // 管理画面トップ
    Route::get('/',[ManagerController::class, 'index'])->name('manager.index');
    // ログアウト処理
    Route::post('/logout',[ManagerAuthController::class, 'logout'])->name('manager.logout');
});

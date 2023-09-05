<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Cat\CatController;

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
    // 動物保護団体画面トップ
    Route::get('/',[AdminController::class, 'index'])->name('admin.index');
    // 動物保護団体情報編集画面表示
    Route::get('/edit',[AdminController::class, 'edit'])->name('admin.edit');
    // 動物保護団体情報編集処理
    Route::post('/edit',[AdminController::class, 'update'])->name('admin.update');
    
    // 猫情報一覧表示
    Route::get('/cats',[CatController::class, 'index'])->name('index.cats');
    // 猫新規登録画面表示
    Route::get('/cats/create',[CatController::class, 'create'])->name('create.cats');
    // 猫情報登録処理
    Route::post('/cats/create',[CatController::class, 'store'])->name('store.cats');
    // 猫情報詳細画面表示
    Route::get('/cats/{cat}',[CatController::class, 'show'])->name('show.cats');
    // 猫情報編集画面表示
    Route::get('/cats/{cat}/edit',[CatController::class, 'edit'])->name('edit.cats');
    // 猫情報編集処理
    Route::post('/cats/{cat}/edit',[CatController::class, 'update'])->name('update.cats');
    // 猫情報削除処理
    Route::post('/cats/{cat}/delete',[CatController::class, 'destroy'])->name('delete.cats');

    // ログアウト処理
    Route::post('/logout',[AuthController::class, 'logout'])->name('admin.logout');
});
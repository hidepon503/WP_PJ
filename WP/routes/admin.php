<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Cat\CatController;
use App\Http\Controllers\Admin\AdminMatchingController;
use App\Http\Controllers\Admin\AdminUserCatController;



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

    // マッチングした猫のPOST投稿ページ表示
    Route::get('/matching/{cat}/post',[CatController::class, 'make'])->name('postCat.create');
    // マッチングした猫のPOST投稿送信
    Route::post('/matching/{cat}/post',[CatController::class, 'save'])->name('postCat.store');
    // マッチングした猫のPOST内容表示
    Route::get('/matching/{cat}/post/{post}',[CatController::class, 'postShow'])->name('postCat.show');


    // マッチングした猫のPOST編集ページ表示
    Route::get('/matching/{cat}/post/{post}/edit',[CatController::class, 'postEdit'])->name('postCat.edit');
    // マッチングした猫のPOST編集送信
    Route::patch('/matching/{cat}/post/{post}',[CatController::class, 'postUpdate'])->name('postCat.update');
    // マッチングした猫のPOST削除
    Route::delete('/matching/{cat}/post/{post}',[CatController::class, 'postDestroy'])->name('postCat.destroy');





    // 保護団体が登録した猫のマッチング申請一覧表示
    Route::get('/match',[AdminMatchingController::class, 'index'])->name('match.index');
    // マッチング申請の拒否一覧の表示
    Route::get('/match/reject', [AdminMatchingController::class, 'rejectIndex'])->name('match.rejectIndex');
    // 保護団体が登録した猫のマッチング申請詳細表示
    Route::get('/match/{matching}',[AdminMatchingController::class, 'show'])->name('match.show');
    // 保護団体が登録した猫のマッチング申請の受理
    Route::post('/match/{matching}/approve', [AdminMatchingController::class, 'approve'])->name('match.approve');
    // 保護団体が登録した猫のマッチング申請の拒否
    Route::post('/match/{matching}/reject', [AdminMatchingController::class, 'reject'])->name('match.reject');

    // 契約者からの返却依頼一覧を取得
    Route::get('/return', [AdminMatchingController::class, 'return'])->name('return.index');
    // 特定の返却依頼の詳細を表示
    Route::get('/return/{user_cat}', [AdminMatchingController::class, 'returnShow'])->name('return.show');
    // 返却申請の受理
    Route::post('/match/{matching}', [AdminMatchingController::class, 'returnApprove'])->name('return.approve');
    // 返却申請の拒否
    Route::post('/match/{matching}/reject', [AdminMatchingController::class, 'reject'])->name('match.reject');

    // // 返却された猫の一覧を取得
    // Route::get('/contract/return', [AdminUserCatController::class, 'return'])->name('return.complete');
    // // 特定の返却された猫の詳細を表示
    // Route::get('/contract/return/{user_cat}', [AdminUserCatController::class, 'returnShow'])->name('return.show');

    
    // 保護団体が登録した猫の契約一覧を取得
    Route::get('/contract', [AdminUserCatController::class, 'contractIndex'])->name('contract.index');
    // 特定の契約の詳細を表示
    Route::get('/contract/show/{user_cat}', [AdminUserCatController::class, 'contractShow'])->name('contract.show');
    // 特定の契約の編集画面を表示
    Route::get('/contract/edit/{user_cat}/', [AdminUserCatController::class, 'contractEdit'])->name('contract.edit');
    // 特定の契約の編集処理
    Route::post('/contract/edit/{user_cat}/', [AdminUserCatController::class, 'contractUpdate'])->name('contract.update');
    // 特定の契約の削除処理（誤って契約処理をしてしまった時のみ利用すること）
    Route::post('/contract/edit/{user_cat}/delete', [AdminUserCatController::class, 'contractDestroy'])->name('contract.destroy');


    // 迷子になった猫の一覧を取得
    Route::get('/contract/lost', [AdminMatchingController::class, 'lost'])->name('lost.index');
    // 特定の迷子になった猫の詳細を表示
    Route::get('/contract/lost/{user_cat}', [AdminMatchingController::class, 'lostShow'])->name('lost.show');
    // 迷子申請の受理
    Route::post('/contract/lost/{user_cat}', [AdminMatchingController::class, 'lostApprove'])->name('lost.approve');

    // 発見された猫の一覧を取得
    Route::get('/contract/found', [AdminMatchingController::class, 'found'])->name('found.index');
    // 特定の発見された猫の詳細を表示
    Route::get('/contract/found/{user_cat}', [AdminMatchingController::class, 'foundShow'])->name('found.show');
    // 発見報告の受理
    Route::post('/contract/found/{user_cat}', [AdminMatchingController::class, 'foundApprove'])->name('found.approve');

    // 契約者が看取った猫の一覧を取得
    Route::get('/contract/death', [AdminMatchingController::class, 'death'])->name('death.index');
    // 特定の看取った猫の詳細を表示
    Route::get('/contract/death/{user_cat}', [AdminMatchingController::class, 'deathShow'])->name('death.show');
    // 看取り報告の受理
    Route::post('/contract/death/{user_cat}', [AdminMatchingController::class, 'deathApprove'])->name('death.approve');

    



    // ログアウト処理
    Route::post('/logout',[AuthController::class, 'logout'])->name('admin.logout');
});
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\Admin\StoreAdminRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * ユーザー登録画面表示
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * ユーザー登録処理
     */
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();
        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);
        // telがフォームから正しく受け取られていることを確認
        $validated['tel'] = $request->input('tel');
        // // 画像がアップロードされている場合のみ処理を行う
        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request->file('image')->store('admins', 'public');
        // }
        // Adminアカウントを新規作成し、インスタンスを$adminに代入
        $admin = Admin::create($validated);
        // 作成したAdminアカウントでログイン
        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.index')->with('success', 'ユーザー登録が完了しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // matchingsテーブルに保存されている、自分の猫宛のマッチング申請を取得して通知を表示する
    public function dashboard()
    {
        $notifications = Matching::where('status', 'requested')->count();
        return view('admin.dashboard', compact('notifications'));
    }
}

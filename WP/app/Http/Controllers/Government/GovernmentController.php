<?php

namespace App\Http\Controllers\Government;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Government;
use App\Http\Requests\Government\StoreGovernmentRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('government.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('government.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGovernmentRequest $request)
    {
        $validated = $request->validated();
        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);
        // Governmentアカウントを新規作成し、インスタンスを$governmentに代入
        $government = Government::create($validated);
        // 作成したGovernmentアカウントでログイン
        Auth::guard('government')->login($government);

        // ログイン後のページへリダイレクト
        return redirect()->route('government.index')->with('success', 'ユーザー登録が完了しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Government $Government)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Government $Government)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Government $Government)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Government $Government)
    {
        //
    }
}

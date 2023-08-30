<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Http\Requests\Manager\StoreManagerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManagerRequest $request)
    {
        $validated = $request->validated();
        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);
        // Managerアカウントを新規作成し、インスタンスを$managerに代入
        $manager = Manager::create($validated);
        // 作成したManagerアカウントでログイン
        Auth::guard('manager')->login($manager);

        return redirect()->route('manager.index')->with('success', 'ユーザー登録が完了しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}

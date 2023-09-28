<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserCat;
use Illuminate\Support\Facades\Auth;


class AdminUserCatController extends Controller
{
    // 現在のadminのIDを取得
    public function contractIndex()
    {
        $admin_id = Auth::id(); 

        $userCats = UserCat::with(['cat', 'user', 'relation'])
            ->whereHas('cat', function($query) use ($admin_id){
                $query->where('admin_id', $admin_id);
            })
            ->get();

        return view('admin.userCatIndex', ['userCats' => $userCats]);
    }

    /**
     * 特定の猫と飼い主であるユーザーの詳細を表示する
     */
    public function show($catId, $userId)
    {
        $userCat = UserCat::where('cat_id', $catId)->where('user_id', $userId)->first();

        if (!$userCat) {
            // データが存在しない場合の処理（エラーメッセージの表示やリダイレクトなど）
            return redirect()->back()->with('error', 'Data not found');
        }

        return view('usercat.show', ['userCat' => $userCat]);
    }


}

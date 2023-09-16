<?php

namespace App\Http\Controllers;

use App\Models\UserCat;
use Illuminate\Http\Request;
use App\Models\Cat;

class UserCatController extends Controller
{
    /**
     * 特定の猫の飼い主一覧を表示する
    **/
    public function index($catId)  // $catIdをパラメータとして受け取る
    {
        // $catIdを元に、Catモデルからデータを取得する
        $cat = Cat::with('users')->find($catId);

        if (!$cat) {
            // 猫のデータが存在しない場合の処理
            return redirect()->back()->with('error', 'Cat not found');
        }

        return view('usercat.index', ['cat' => $cat]);

        // Viewの中で以下のように書く
        // @foreach($cat->users as $user)
        // {{ $user->name }} - {{ $user->pivot->started_at }} - {{ $user->pivot->ended_at }} - {{ $user->pivot->relationship_type }}
        // @endforeach
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

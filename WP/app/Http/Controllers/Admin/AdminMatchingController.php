<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matching;
use App\Models\UserCat;
use Illuminate\Support\Facades\Auth;



class AdminMatchingController extends Controller
{
    // cat_id内のadmin_idの情報がログインしているidと一致する猫のマッチング一覧を表示する
    public function index()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 1)
            ->get();

        return view('admin.matchingIndex', ['matchings' => $matchings]);
    }

    // マッチング申請を受理し、user_catsテーブルにデータを保存する
    public function approve($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->request_id = '1';

        $matching->save();

        UserCat::create([
            'user_id' => $matching->user_id,
            'cat_id' => $matching->cat_id,
            'relation_id' => $matching->request_id,
            'started_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Matching approved!');
    }

    // マッチング申請を拒否する
    public function reject(Request $request, $matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->status = 'rejected';
        // ここに拒否の理由を保存するコードを追加
        $matching->save();

        return redirect()->back()->with('message', 'Matching rejected.');
    }
}

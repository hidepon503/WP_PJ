<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matching;
use App\Models\UserCat;
use App\Models\Cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
            ->get();
        // $matchings = DB::table('matchings')
        //                 ->join('cats', 'matchings.cat_id', '=', 'cats.id')
        //                 ->join('users', 'matchings.user_id', '=', 'users.id')  // usersテーブルとも結合
        //                 ->where('cats.admin_id', '=', $admin_id)
        //                 ->select(
        //                     'matchings.*',
        //                     'cats.name as cat_name', 
        //                     'cats.image as cat_image_url',
        //                     'users.name as user_name',  // usersテーブルからnameを選択
        //                     'users.email as user_email' // usersテーブルからemailを選択
        //                 )
        //                 ->get();

        return view('admin.matchingIndex', ['matchings' => $matchings]);
    }

    // マッチング申請を受理し、user_catsテーブルにデータを保存する
    public function approve($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->status = 'approved';
        $matching->save();

        UserCat::create([
            'user_id' => $matching->user_id,
            'cat_id' => $matching->cat_id,
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

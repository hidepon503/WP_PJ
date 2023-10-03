<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matching;
use App\Models\UserCat;
use App\Models\Cat;

use Illuminate\Support\Facades\Auth;



class AdminMatchingController extends Controller
{
    // cat_id内のadmin_idの情報がログインしているidと一致する猫のマッチング一覧を表示する
    public function index()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user', 'request'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 1)
            ->get();

        return view('admin.matchingIndex', ['matchings' => $matchings]);
    }

    // マッチング申請の詳細を表示する
    public function show($matchingId)
    {
        $matching = Matching::with(['cat', 'user', 'request'])->find($matchingId);

        return view('admin.matchingShow', ['matching' => $matching]);
    }

    // マッチング申請を受理し、user_catsテーブルにデータを保存する
    public function approve($matchingId)
    {
        // matchingテーブルのrequest_idを2に更新
        Matching::where('id', $matchingId)->update(['request_id' => '2']);
        
        // 対応するマッチング情報を取得
        $matching = Matching::find($matchingId);

        // cat_idと一致するcatsテーブルのidのレコードのstatusカラムを1に変更する
        $cat = Cat::where('id', $matching->cat_id)->update(['status_id' => '3']);

        UserCat::create([
            'user_id' => $matching->user_id,
            'cat_id' => $matching->cat_id,
            'relation_id' => $matching->request_id = '1',
            'started_at' => now(),
        ]);

        return redirect()->back()->with('message', 'マッチング申請を受理しました。');
    }

    // マッチング申請の拒否一覧を表示する
    public function rejectIndex()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user', 'request'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 3)
            ->get();

        return view('admin.rejectIndex', ['matchings' => $matchings]);
    }

    // マッチング申請を拒否する
    public function reject(Request $request, $matchingId)
    {
        // matchingテーブルのrequest_idを2に更新
        Matching::where('id', $matchingId)->update(['request_id' => '3']);

        // matchingsテーブルのcat_idと同じcatテーブルのレコードのstatus_idを変更
        $cat = Cat::find($cat_id);
        $cat->status_id = '2';//募集中
        $cat->save();

        return redirect()->back()->with('message', 'Matching rejected.');
    }

    // cat_id内のadmin_idの情報がログインしているidと一致する猫のマッチング一覧を表示する
    public function return()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user', 'request'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 4)
            ->get();

        return view('admin.return', ['matchings' => $matchings]);
    }

    public function returnApprove($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->request_id = '5';
        $matching->update();

        // cat_idと一致するcatsテーブルのidのレコードのstatusカラムを1（準備中）に変更する
        $cat = Cat::where('id', $matching->cat_id)->update(['status_id' => '1']);

        // user_id と cat_id が一致するレコードの更新を行う
        UserCat::where('user_id', $matching->user_id)
                ->where('cat_id', $matching->cat_id)
                ->update([
                    'relation_id' => '2',// 2は返却済み
                    'ended_at' => now()
                ]);

        return redirect()->back()->with('message', '引取り申請を受理しました。');
    }

    // cat_id内のadmin_idの情報がログインしているidと一致する猫のマッチング一覧を表示する
    public function lost()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user', 'request'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 6)
            ->get();

        return view('admin.lost', ['matchings' => $matchings]);
    }

    public function lostApprove($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->request_id = '7';
        $matching->save();

        return redirect()->back()->with('message', '迷子申請を受理しました。');
    }

        // cat_id内のadmin_idの情報がログインしているidと一致する猫のマッチング一覧を表示する
    public function found()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user', 'request'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 8)
            ->get();

        return view('admin.found', ['matchings' => $matchings]);
    }

    public function foundApprove($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->request_id = '2';
        $matching->save();

        return redirect()->back()->with('message', '迷子発見報告を受理しました。');
    }

    
    // cat_id内のadmin_idの情報がログインしているidと一致する猫のマッチング一覧を表示する
    public function death()
    {
        $admin_id = Auth::id(); // 現在のadminのIDを取得

        $matchings = Matching::with(['cat', 'user', 'request'])
            ->whereHas('cat', function ($query) use ($admin_id) {
                $query->where('admin_id', $admin_id);
            })
            ->where('request_id', 9)
            ->get();

        return view('admin.death', ['matchings' => $matchings]);
    }

    public function deathApprove($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->request_id = '10';
        $matching->save();

        // cat_idと一致するcatsテーブルのidのレコードのstatusカラムを1（準備中）に変更する
        $cat = Cat::where('id', $matching->cat_id)->update(['status_id' => '7']);

        // user_id と cat_id が一致するレコードの更新を行う
        UserCat::where('user_id', $matching->user_id)
                ->where('cat_id', $matching->cat_id)
                ->update([
                    'relation_id' => '3',// 2は返却済み
                    'ended_at' => now()
                ]);

        return redirect()->back()->with('message', '看取り報告を受理しました。');
    }



}

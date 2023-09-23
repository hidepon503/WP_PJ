<?php

namespace App\Http\Controllers;

use App\Models\Matching;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Request as RequestModel;
use App\Models\UserCat;


class MatchingController extends Controller
{
    /**
     * マッチングを申請し、matchingsテーブルにrequestsテーブルのId1を保存する
     */
    public function store(Request $request, $cat_id) 
    {   
        // "requested"の回答のIDを取得
        $requestedId = RequestModel::where('answer', 'マッチング申請中')->first()->id;

        // マッチング受理のIDを取得
        $acceptedId = RequestModel::where('answer', '契約中')->first()->id;

        // ユーザーが最後にマッチング受理された日時を取得
        $lastAccepted = Matching::where('user_id', auth()->id())
                                ->where('request_id', $acceptedId)
                                ->latest('created_at')
                                ->first();

        // //テスト環境のため制限は解除している。

        // // 最後のマッチング受理から半年間は、新しいマッチング受付を禁止
        // if($lastAccepted && $lastAccepted->created_at->addMonths(6)->isFuture()) {
        //     return redirect()->back()->with('error', '新規契約後、半年間は新しい申請ができません。');
        // }

        // // ユーザーが現在のマッチング受理件数を取得
        // $currentAcceptedCount = Matching::where('user_id', auth()->id())->where('request_id', $acceptedId)->count();

        // // マッチング受理が3件以上存在する場合は、新しいマッチング受付を禁止
        // if($currentAcceptedCount >= 3) {
        //     return redirect()->back()->with('error', '契約可能件数は3件までです。新しいマッチング申請はできません。');
        // }

        // // ユーザーが現在のマッチング申請数を取得
        // $currentRequests = Matching::where('user_id', auth()->id())->where('request_id', $requestedId)->count();

        // // 申請数が1件を超えている場合はエラーメッセージを返す
        // if($currentRequests >= 1) {
        //     return redirect()->back()->with('error', '申請上限に達しました。');
        // }

        // 以下のマッチング申請処理は変更なし
        $matching = new Matching();
        $matching->user_id = auth()->id();
        $cat = Cat::find($cat_id);
        $matching->cat_id = $cat->id;
        $matching->request_id = $requestedId;
        $matching->save();
        
        $cat->status_id = '4';
        $cat->save();

        return redirect()->back()->with('success', 'マッチング申請を送りました。');
    }

    public function destroy($matchingId)
    {
        $matching = Matching::find($matchingId);
        $matching->delete();

        return redirect()->back()->with('success', 'マッチング申請を取り消しました。');
    }

    public function show($cat_id, $user_id)
    {
        // cat_idとuser_idを使って、正確なmatchingを取得
        $matching = Matching::where('cat_id', $cat_id)->where('user_id', $user_id)->first();

        if (!$matching) {
            abort(404);  // 見つからない場合は404エラーを返す
        }

        // ログインしているユーザーのIDと一致するuser_idを持つレコードをuser_catsテーブルから取得し、変数に代入。さらにuser_catsテーブルと外部キー接続しているrelationsテーブルから、nameを取得する。
        $user_cat = UserCat::where('user_id', auth()->id())->where('cat_id', $cat_id)->with('relation')->first();

        if($matching->cat->birthday) {
            $birthday = new \Carbon\Carbon($matching->cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $admin = $matching->cat->admin;
        $kind = $matching->cat->kind;
        $gender = $matching->cat->gender;

        return view('user.matchingShow', compact('matching',  'user_cat', 'age','admin', 'kind', 'gender'));
    }

    public function application($cat_id, $user_id)
    {
        // cat_idとuser_idを使って、正確なmatchingを取得
        $matching = Matching::where('cat_id', $cat_id)->where('user_id', $user_id)->first();

        if (!$matching) {
            abort(404);  // 見つからない場合は404エラーを返す
        }

        // ログインしているユーザーのIDと一致するuser_idを持つレコードをuser_catsテーブルから取得し、変数に代入。さらにuser_catsテーブルと外部キー接続しているrelationsテーブルから、nameを取得する。
        $user_cat = UserCat::where('user_id', auth()->id())->where('cat_id', $cat_id)->with('relation')->first();

        if($matching->cat->birthday) {
            $birthday = new \Carbon\Carbon($matching->cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $admin = $matching->cat->admin;
        $kind = $matching->cat->kind;
        $gender = $matching->cat->gender;

        return view('user.application', compact('matching',  'user_cat', 'age','admin', 'kind', 'gender'));
    }

    public function comeback($cat_id, $user_id)
    {
        // cat_idとuser_idを使って、正確なmatchingを取得
        $matching = Matching::where('cat_id', $cat_id)->where('user_id', $user_id)->first();

        if (!$matching) {
            abort(404);  // 見つからない場合は404エラーを返す
        }

        // ログインしているユーザーのIDと一致するuser_idを持つレコードをuser_catsテーブルから取得し、変数に代入。さらにuser_catsテーブルと外部キー接続しているrelationsテーブルから、nameを取得する。
        $user_cat = UserCat::where('user_id', auth()->id())->where('cat_id', $cat_id)->with('relation')->first();

        if($matching->cat->birthday) {
            $birthday = new \Carbon\Carbon($matching->cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $admin = $matching->cat->admin;
        $kind = $matching->cat->kind;
        $gender = $matching->cat->gender;

        return view('user.comeback', compact('matching', 'user_cat', 'age','admin', 'kind', 'gender'));
    }
    
    public function comebackRequest(Request $request,$cat_id, $user_id)
    {
        // cat_idとuser_idを使って、正確なmatchingを取得
        $matching = Matching::where('cat_id', $cat_id)->where('user_id', auth()->id())->first();

        if (!$matching) {
            abort(404);  // 見つからない場合は404エラーを返す
        }

        // リクエストから受け取ったrequest_idでカラムを更新
        $matching->request_id = $request->input('request_id');
        $matching->save();

        // ログインしているユーザーのIDと一致するuser_idを持つレコードをuser_catsテーブルから取得し、変数に代入。さらにuser_catsテーブルと外部キー接続しているrelationsテーブルから、nameを取得する。
        $user_cat = UserCat::where('user_id', auth()->id())->where('cat_id', $cat_id)->with('relation')->first();

        if($matching->cat->birthday) {
            $birthday = new \Carbon\Carbon($matching->cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $admin = $matching->cat->admin;
        $kind = $matching->cat->kind;
        $gender = $matching->cat->gender;

        // matchingsテーブルの任意のレコードのデータの更新





        return view('user.cbComplete', compact('matching', 'user_cat', 'age','admin', 'kind', 'gender'));
    }

}

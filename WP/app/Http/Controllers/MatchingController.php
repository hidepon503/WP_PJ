<?php

namespace App\Http\Controllers;

use App\Models\Matching;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Request as RequestModel;


class MatchingController extends Controller
{
    /**
     * マッチングを申請し、matchingsテーブルにrequestsテーブルのId1を保存する
     */
    public function store(Request $request, $cat_id) 
    {   

        // "requested"の回答のIDを取得
        $requestedId = RequestModel::where('answer', 'マッチング受付')->first()->id;

        // ユーザーが現在のマッチング申請数を取得
        $currentRequests = Matching::where('user_id', auth()->id())->where('request_id', $requestedId)->count();
    
        // 申請数が1件を超えているか、既にマッチングが受理されている場合はエラーメッセージを返す
        if($currentRequests >= 1) {
            return redirect()->back()->with('error', '申請上限に達しました。');
        }
    
        // マッチング申請をデータベースに保存
        $matching = new Matching();
        $matching->user_id = auth()->id();

        // 申請された猫の情報を取得
        $cat = Cat::find($cat_id);

        $matching->cat_id = $cat->id;
        // マッチング申請をデータベースに保存時にも、request_idをセット
        $matching->request_id = $requestedId;
        $matching->save();
    
        return redirect()->back()->with('success', 'マッチング申請を送りました。');
    }


    
    
    
    

}

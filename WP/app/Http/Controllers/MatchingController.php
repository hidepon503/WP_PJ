<?php

namespace App\Http\Controllers;

use App\Models\Matching;
use Illuminate\Http\Request;
use App\Http\Requests\MatchingRequest;
use App\Models\Cat;
use App\Models\User;
use App\Models\Auth;


class MatchingController extends Controller
{
    /**
     * マッチングを申請し、matchingsテーブルにrequestedを保存する
     */
    public function store(Request $request, $cat_id) 
    {   

        // ユーザーが現在のマッチング申請数を取得
        $currentRequests = Matching::where('user_id', auth()->id())->where('status', 'requested')->count();
    
        // 申請数が5件を超えているか、既にマッチングが受理されている場合はエラーメッセージを返す
        if($currentRequests >= 5) {
            return redirect()->back()->with('error', '申請上限に達しました。');
        }
    
        // マッチング申請をデータベースに保存
        $matching = new Matching();
        $matching->user_id = auth()->id();

        // 申請された猫の情報を取得
        $cat = Cat::find($cat_id);

        $matching->cat_id = $cat->id;
        $matching->status = 'requested';
        $matching->save();
    
        return redirect()->back()->with('success', 'マッチング申請を送りました。');
    }

    public function approve(Matching $matching) 
    {
        $matching->status = 'approved';
        $matching->save();

        return redirect()->back()->with('success', 'マッチングを受理しました。');
    }

    public function reject(Matching $matching) 
    {
        $matching->status = 'rejected';
        $matching->save();
        
        return redirect()->back()->with('success', 'マッチングを拒否しました。');
    }
    
    
    
    

}

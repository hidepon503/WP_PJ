<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * お気に入り登録
     *
     * @param  Request  $request
     * @param  Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function toggleFavorite(Request $request, $catId)
    {
        $user = auth()->user();
        $favorite = $user->favorites()->where('cat_id', $catId)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            $user->favorites()->create(['cat_id' => $catId]);
            return response()->json(['status' => 'added']);
        }
    }

    // お気に入り一覧
    public function index(Request $request)
    {
        // お気に入り登録した猫の取得
        $query = auth()->user()->favoriteCats();
    
        // リクエストデータをセッションに保存
        $request->flash();
    
        // gender_idが設定されているか確認し、クエリに追加します。
        if ($request->filled('gender_id')) {
            $query->where('gender_id', $request->input('gender_id'));
        }
        // kind_idが設定されているか確認し、クエリに追加します。
        if ($request->filled('kind_id')) {
            $query->where('kind_id', $request->input('kind_id'));
        }
    
        $order = $request->get('order', 'cat_created');  // デフォルトは猫の登録順
    
        switch ($order) {
            case 'favorite_created_asc':
                $query->orderBy('favorites.created_at', 'asc');  // お気に入り登録日の昇順
                break;
            case 'favorite_created_desc':
                $query->orderBy('favorites.created_at', 'desc'); // お気に入り登録日の降順
                break;
            // ... 他のケースも同様に修正 ...
        }
    
        $favorites = $query->paginate(20);  // ページネーションを適用
    
        return view('user.favorites', ['favorites' => $favorites, 'order' => $order]);
    }

}

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
}

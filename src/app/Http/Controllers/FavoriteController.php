<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $shopId = $request->shop_id;

        // ユーザーと店舗の組み合わせがすでに存在するか確認
        $existingFavorite = Favorite::where('user_id', auth()->id())
            ->where('shop_id', $shopId)
            ->exists();

        // すでにお気に入りに追加されている場合は何もしない
        if ($existingFavorite) {
            return response()->json(['message' => 'すでにお気に入りに追加されています']);
        }

        Favorite::create(['user_id' => auth()->id(), 'shop_id' => $shopId]);

        // レスポンス
        return response()->json(['message' => 'お気に入りに追加しました']);
    }
}

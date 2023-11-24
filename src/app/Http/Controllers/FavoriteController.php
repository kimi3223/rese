<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $request->shop_id を使用してデータベースに保存
        Favorite::create(['user_id' => auth()->id(), 'shop_id' => $request->shop_id]);

        // レスポンス
        return response()->json(['message' => 'お気に入りに追加しました']);
    }
}

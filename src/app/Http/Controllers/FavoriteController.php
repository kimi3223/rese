<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $shopId = $request->shop_id;
        Favorite::create(['user_id' => auth()->id(), 'shop_id' => $shopId]);

        // レスポンス
        return response()->json(['message' => 'お気に入りに追加しました']);
    }
}

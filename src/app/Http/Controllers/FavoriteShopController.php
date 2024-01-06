<?php

namespace App\Http\Controllers;

use App\Models\FavoriteShop;
use Illuminate\Http\Request;

class FavoriteShopController extends Controller
{
    public function index()
    {
        // ログインしているユーザーのお気に入りデータを取得
        $user = auth()->user();
        $favoriteShops = $user->favoriteShops()->with('shop')->get();

        return view('user.mypage', ['favoriteShops' => $favoriteShops]);
    }

    public function store(Request $request)
    {
        $shopId = $request->shop_id;

        // ユーザーと店舗の組み合わせがすでに存在するか確認
        $existingFavorite = FavoriteShop::where('user_id', auth()->id())
            ->where('shop_id', $shopId)
            ->exists();

        // すでにお気に入りに追加されている場合は何もしない
        if ($existingFavorite) {
            return response()->json(['message' => 'すでにお気に入りに追加されています']);
        }

        // 新しいお気に入りを作成
        $favorite = new FavoriteShop(['user_id' => auth()->id(), 'shop_id' => $shopId]);
        $favorite->save();

        // レスポンス
        return response()->json(['message' => 'お気に入りに追加しました', 'favorite_id' => $favorite->id]);
    }

    public function getFavoritesForUser()
    {
        // ログインしているユーザーのお気に入りデータを取得
        $user = auth()->user();
        $favoriteShops = $user->favorites()->with('shop')->get();

        // ここで取得したデータを利用して何かしらの処理を行う（例：ビューに渡す、JSONレスポンスとして返す等）
        // ...

        return view('favorites.index', ['favoriteShops' => $favoriteShops]);
    }

    public function destroy(FavoriteShop $favorite)
    {
    // ログインユーザーがお気に入りを削除できるか確認
    if ($favorite->user_id !== auth()->id()) {
        return response()->json(['message' => '権限がありません'], 403);
    }

    // お気に入りを削除する処理
    $favorite->delete();

    // レスポンス
    return response()->json(['success' => true, 'favorite_id' => $favorite->id]);
    }

    public function addFavoriteToMyPage($favoriteId)
    {
        // お気に入りの情報を取得
        $favorite = FavoriteShop::find($favoriteId);

        // ユーザー認証の確認なども行うと良いでしょう
        // ...

        $user = \Auth::user();
        // myPageFavorites メソッドが実装されていることを確認し、存在する場合は create を実行
        if (!$user->myPageFavorites()->where('shop_id', $favorite->shop_id)->exists()) {
            $user->myPageFavorites()->create([
                'shop_id' => $favorite->shop_id,
            ]);
        }
    }

    public function toggleFavorite($shopId)
    {
        $user = auth()->user();

        // お気に入りにすでに登録されているか確認
        if ($user->favoriteShops()->where('shop_id', $shopId)->exists()) {
            // お気に入りから削除
            $user->favoriteShops()->detach($shopId);
            $status = 'removed';
        } else {
            // お気に入りに追加
            $user->favoriteShops()->attach($shopId);
            $status = 'added';
        }

        return response()->json(['status' => $status, 'is_favorite' => $status === 'added', 'message' => 'お気に入りを更新しました']);
    }
    public function isFavorite($shopId)
    {
    $user = auth()->user();
    $isFavorite = $user->favoriteShops()->where('shop_id', $shopId)->exists();
    
    return response()->json(['is_favorite' => $isFavorite]);
    }
}

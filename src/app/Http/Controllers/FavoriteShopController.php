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

    public function destroy($id)
    {
    // お気に入りの取得
    $favorite = FavoriteShop::find($id);

    // お気に入りが存在しない場合はエラーレスポンスを返すなど、適切な処理を追加する
    if (!$favorite) {
        return response()->json(['message' => 'お気に入りが見つかりません'], 404);
    }

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
        $favorite = FavoriteShop::findOrFail($favoriteId);

        // ユーザー認証の確認なども行うと良いでしょう
        // ...

        $user = \Auth::user();
        // myPageFavorites メソッドが実装されていることを確認し、存在する場合は create を実行
        if (method_exists($user, 'myPageFavorites')) {
            $user->myPageFavorites()->create([
                'shop_id' => $favorite->shop_id,
            ]);
        }

        // 必要に応じてリダイレクトや他の処理を追加
    }
}

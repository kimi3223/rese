<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;

class UserController extends Controller
{
    public function showMyPage()
    {
        // ユーザーのお気に入り店舗を取得
        $user = auth()->user();
        $favoriteShops = $user->favorites()->with('shop')->get();

        // ユーザー情報を取得
        $userInfo = Auth::user();

        // 他のショップの取得（例：すべてのショップを取得）
        $shops = Shop::all();

        return view('user.mypage', compact('favoriteShops', 'userInfo'));
    }
}
